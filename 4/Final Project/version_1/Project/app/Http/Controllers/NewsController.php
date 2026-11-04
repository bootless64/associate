<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function generateFakeNews()
    {
        $news = \App\Models\News::factory()->create();
        return response()->json($news);
    }

    public function allNews(){
        $news = News::latest()->paginate(12);
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $news = News::with('comments.user')->findOrFail($id);
        return view('news.show', compact('news'));
    }


    public function manageNews(Request $request)
    {
        $query = News::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request){
                $q->where('name', 'like', '%'.$request->user_name.'%');
            });
        }
        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.$request->title.'%');
        }
        if ($request->filled('content')) {
            $query->where('content', 'like', '%'.$request->content.'%');
        }

        $news = $query->orderBy('id','desc')->paginate(20)
                      ->appends($request->only(['id','user_name','title','content']));

        return view('dashboard.manage-news.index', compact('news'));
    }



    public function create()
    {
        return view('dashboard.manage-news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:500', // حداکثر 500 کیلوبایت
            'slider_images' => 'nullable|array|max:10', //حداکثر 10 تا عکس
            'slider_images.*' => 'image|max:500'
        ]);

        $news = new News();
        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $image = $validated['image'];
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/news', $filename);
            $news->image = $filename;
        }

        if ($request->hasFile('slider_images')) {
            $newSliderImages = [];
            foreach ($validated['slider_images'] as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/news', $filename);
                $newSliderImages[] = $filename; //push image name to slider images array
            }
            $news->slider_images = $newSliderImages;
        }

        $news->save();
        return redirect()->route('dashboard.manage-news.index')->with('success', 'خبر با موفقیت منتشر شد.');
    }



    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('dashboard.manage-news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:500', // حداکثر 500 کیلوبایت
            'slider_images' => 'nullable|array|max:10', //حداکثر 10 تا عکس
            'slider_images.*' => 'image|max:500'
        ]);

        $news->title = $validated['title'];
        $news->content = $validated['content'];

        if ($request->has('remove_image') && $news->image)
        {
            Storage::delete('public/news/' . $news->image);
            $news->image = null;
        }

        if ($request->hasFile('image') && $request->missing('remove_image')) {

            if ($news->image) {
                Storage::delete('public/news/' . $news->image);
            }
            $image = $validated['image'];
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/news', $filename);
            $news->image = $filename;
        }


        if ($request->has('remove_slider') && $news->slider_images)
        {
            foreach ($news->slider_images as $image) {
                Storage::delete('public/news/' . $image);
            }
            $news->slider_images = null;
        }

        if ($request->hasFile('slider_images') && $request->missing('remove_slider')) {

            if ($news->slider_images) {
                foreach ($news->slider_images as $image) {
                    Storage::delete('public/news/' . $image);
                }
            }

            $newSliderImages = [];
            foreach ($validated['slider_images'] as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/news', $filename);
                $newSliderImages[] = $filename; //push image name to slider images array
            }
            $news->slider_images = $newSliderImages;
        }

        $news->save();
        return redirect()->route('dashboard.manage-news.index')->with('success', 'خبر با موفقیت ویرایش شد.');

    }



    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::delete('public/news/' . $news->image);
        }

        if ($news->slider_images) {
            foreach ($news->slider_images as $image) {
                Storage::delete('public/news/' . $image);
            }
        }

        $news->delete();
        return back()->with('success', 'خبر حذف شد.');
    }

}
