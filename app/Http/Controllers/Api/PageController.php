<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::get();
        if(!$pages)  return response()->json(['status' => false, 'message' => 'Ошибка получения страниц из базы']);

        return response()->json(compact('pages'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->role->permissions->where('slug','page:create' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав создавать']);
        }
        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => 'required|min:3|unique:pages',
                'tags_ru' => 'array|nullable',
                'tags_uk' => 'array|nullable',
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'description_ru' => 'string|nullable',
                'description_uk' => 'string|nullable',
                'visible' => 'boolean|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $page = new Page();
        $page->name_ru = $request->name_ru;
        $page->name_uk = $request->name_uk;
        $page->description_ru = $request->description_ru;
        $page->description_uk = $request->description_uk;
        $page->text_ru = $request->text_ru;
        $page->text_uk = $request->text_uk;
        $page->tags_ru = $request->tags_ru;
        $page->tags_uk = $request->tags_uk;
        $page->visible = $request->visible;
        $page->slug = $request->slug;

        $prod = $page->save();

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно создана!']);}
        else {return response()->json(['status' => false, 'message' => 'Страница не создана.']);}
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if (!auth()->user()->role->permissions->where('slug','page:update' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав редактировать']);
        }

        $validator = Validator::make($request->all(),
            [
                'name_ru' => 'required|min:3',
                'name_uk' => 'required|min:3',
                'slug' => ['required', Rule::unique('pages')->ignore($page)],
                'tags_ru' => 'array|nullable',
                'tags_uk' => 'array|nullable',
                'text_ru' => 'string|nullable',
                'text_uk' => 'string|nullable',
                'description_ru' => 'string|nullable',
                'description_uk' => 'string|nullable',
                'visible' => 'boolean|nullable',
            ]
        );
        if($validator->fails()) return response()->json(['status' => false, 'message' => $validator->messages()]);

        $page->name_ru = $request->name_ru;
        $page->name_uk = $request->name_uk;
        $page->description_ru = $request->description_ru;
        $page->description_uk = $request->description_uk;
        $page->text_ru = $request->text_ru;
        $page->text_uk = $request->text_uk;
        $page->tags_ru = $request->tags_ru;
        $page->tags_uk = $request->tags_uk;
        $page->visible = $request->visible;
        $page->slug = $request->slug;

        $prod = $page->save();

        if($prod) {return response()->json(['status' => true, 'message' => 'Успешно обновлена!']);}
        else {return response()->json(['status' => false, 'message' => 'Страница не обнавлена.']);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if (!auth()->user()->role->permissions->where('slug','page:delete' )->first()) {
            return response()->json(['status' => false, 'message' => 'У вас нет прав удалять']);
        }
        if($page->delete())  return response()->json(['status' => true, 'message' => 'Успешно удалена!']);
        return response()->json(['status' => true, 'message' => 'Удалить не удалось!']);
    }
}
