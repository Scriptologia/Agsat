<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getFolder (Request $request){
        $directory = $request->get('directory')? $request->get('directory') : 'public';
        $directories = Storage::directories($directory);
        $arr = [];
        foreach ($directories as $folder) {
            $subfolders = Storage::directories($folder);
            $pieces = explode("/", $folder);
            $name = array_pop($pieces);
            $parent = $directory;
            $hasChildren = false;
            $fullUrl = $folder;
            if($subfolders) $hasChildren = true;
            $arr[] = ['name' => $name, 'parent' =>$parent, 'hasChildren' => $hasChildren, 'fullUrl' => $fullUrl, 'children' => []];
        }
        $files = collect(Storage::files($directory))->map(function($file) use ($directory) {
            $img = ['img' => Storage::url($file), 'selected' => false, 'folder' => $directory];
            return $img;
        });
        return response()->json(['status' => true, 'message' => ['folders' => $arr, 'files' => $files]]);
    }

    private function makeTreeFolders(){

    }

    public function postToFolder(Request $request) {
        $directory = $request->directory;
        $images = $request->images;
        if($directory && !$images){
            if(Storage::makeDirectory($directory)) return response()->json(['status' => true, 'message' => 'Новая папка создана']);
            return response()->json(['status' => false, 'message' => 'Новая папка не создана']);
        }
        else if($directory && $images) {

        }
        else {
            return response()->json(['status' => false, 'message' => 'Не переданы файлы или не указана папка']);
        }

    }
    public function deleteInFolder() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->get('directory')) {
            if(Storage::deleteDirectory($request->get('directory')))
                return response()->json(['status' => true, 'message' => 'Успешна удалена папка и вложенные файлы']);
            return response()->json(['status' => false, 'message' => 'Парка не удалена']);
        }
       else if($request->get('images')) {
            if(Storage::delete($request->get('images')))
                return response()->json(['status' => true, 'message' => 'Успешно удален(ы) файл(ы)']);
            return response()->json(['status' => false, 'message' => 'Файл(ы) не удалены']);
        }
        else { return response()->json(['status' => false, 'message' => 'Не указана папка или файлы']); }

    }
}
