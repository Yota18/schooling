<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master.news.add', ['categories' => NewsCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,News $news)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required', 'max:200'],
                'description' => ['required'],
                'category' => ['required'],
                // 'type_news' => ['required'],
                'date' => ['required'],
                'image'=>['required', 'image','file','max:3024'],
            ],
            customAttributes: [
                'title'=> __('attributes.title'),
                'description' => __('attributes.description'),
                'category' => __('attributes.category'),
                // 'type_news' => __('attributes.type_news'),
                'image' => __('attributes.image'),
                'date' => __('attributes.date'),
            ],
        )->validate();
        

        $insert = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'news_category_id' => $request->category,
            // 'type' => $request->type_news,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'date' => $request->date,
            'slug' => Str::slug($request->title, '-')
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('master.news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return redirect()->to(route('master.news.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('pages.master.news.edit', ['news' => $news, 'categories' => NewsCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title' => ['required', 'max:200'],
                'description' => ['required'],
                'category' => ['required'],
                'date' => ['required'],
                // 'type_news' => ['required'],
            ],
            customAttributes: [
                'title'=> __('attributes.title'),
                'description' => __('attributes.description'),
                'category' => __('attributes.category'),
                'image' => __('attributes.image'),
                'date' => __('attributes.date'),
                // 'type_news' => __('attributes.type_news'),
            ],
        )->validate();

        if ($request->file('image')) {
            Validator::make(
                data: $request->all(),
                rules: [
                    'image'=>['required', 'image','file','max:3024'],
                ],
                customAttributes: [
                    'image' => __('attributes.image'),
                ],
            )->validate();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'news_category_id' => $request->category,
            'date' => $request->date,
            // 'type' => $request->type_news,
            'slug' => Str::slug($request->title_en, '-')
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news/cover');
        }

        if ($news->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('master.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            Storage::disk('public')->delete($news->image);
            $response = array(
                'status' => 'success',
                'message' => 'Berita berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Berita tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }
}
