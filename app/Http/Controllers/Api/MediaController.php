<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function getFolder (Request $request){
        $directory = $request->get('directory')? $request->get('directory') : '';
        $directories = Storage::disk('public')->directories($directory);
        $arr = [];
        $files = [];
        foreach ($directories as $folder) {
//            $subfolders = Storage::disk('public')->directories($folder);
            $pieces = explode("/", $folder);
            $name = array_pop($pieces);
            $parent = $directory;
//            $hasChildren = false;
            $fullUrl = $folder;
//            if($subfolders) $hasChildren = true;
            $arr[] = ['name' => $name, 'parent' =>$parent,'fullUrl' => $fullUrl, 'children' => []];
        }
        if($directory !== '') $files = collect(Storage::disk('public')->files($directory))->map(function($file) use ($directory) {
            $img = ['img' => Storage::url($file), 'selected' => false, 'folder' => $directory, 'realUrl' => $file];
            return $img;
        });

        return response()->json(['status' => true, 'message' => ['folders' => $arr, 'files' => $files] ], 200);
    }

    public function postToFolder(Request $request) {
        $directory = $request->directory;
        $file = $request->file('file');
        if($directory && !$file){
            if(Storage::disk('public')->makeDirectory($directory)) return response()->json(['status' => true, 'message' => 'Новая папка создана'], 200);
            return response()->json(['status' => false, 'message' => 'Новая папка не создана']);
        }
        else if($directory && $file) {
                $path = Storage::disk('public')->putFileAs($directory, $file, date('h-i-s-d-m-Y').'.'.$file->getClientOriginalExtension());
                if(!$path) return response()->json(['status' => false, 'message' => 'Не удалось загрузить файл']);
            return response()->json(['status' => true, 'message' => 'Успешно загружены файл(ы)'], 200);
        }
        else {
            return response()->json(['status' => false, 'message' => 'Не переданы файлы или не указана папка'], 503);
        }
    }

    public function deleteFiles(Request $request)
    {
        if ($request->images) {
                if (Storage::disk('public')->delete($request->images))
                    return response()->json(['status' => true, 'message' => 'Успешно удален(ы) файл(ы)'], 200);
                    return response()->json(['status' => false, 'message' => 'Файл(ы) не удалены']);
                } else {
                    return response()->json(['status' => false, 'message' => 'Не указаны файлы']);
                }
    }

    public function destroy(Request $request)
    {
        $directory= $request->get('directory');
        if($directory) {
             if(!Storage::disk('public')->has($directory)) return response()->json(['status' => false, 'message' => 'Папка не существует']);
            if(Storage::disk('public')->deleteDirectory($directory))
                return response()->json(['status' => true, 'message' => 'Успешна удалена папка и вложенные файлы'], 200);
            return response()->json(['status' => false, 'message' => 'Папка не удалена']);
        }
        else { return response()->json(['status' => false, 'message' => 'Не указана папка']); }

    }
}
