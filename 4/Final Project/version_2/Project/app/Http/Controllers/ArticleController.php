<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function generateFakeArticle()
    {
        $article = \App\Models\Article::factory()->create();
        return response()->json($article);
    }

    public function allApprovedArticles(){
        $articles = Article::where('status', 'approved')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::where('status', 'approved')->with('comments.user')->findOrFail($id);
        return view('articles.show', compact('article'));
    }



    public function manageArticles(Request $request)
    {
        $query = Article::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
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
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $articles = $query->orderBy('id','desc')->paginate(10)
                      ->appends($request->only(['id','type','user_name','title','content','status']));

        return view('dashboard.manage-articles', compact('articles'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'in:pending,approved,rejected',
        ]);

        $article = Article::findOrFail($id);
        $article->status = $validated['status'];
        $article->save();

        return back()->with('success', 'وضعیت مقاله به‌روزرسانی شد.');
    }



    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::delete('public/articles/' . $article->image);
        }
        if ($article->file) {
            Storage::delete('public/articles/files/' . $article->file);
        }

        $article->delete();
        return back()->with('success', 'مقاله حذف شد.');
    }



    public function myArticles()
    {
        /** @var User $user*/
        $user = auth()->user();
        $my_articles = $user->articles()->latest()->paginate(10);
        return view('dashboard.my-articles.index', compact('my_articles'));
    }



    public function create()
    {
        return view('dashboard.my-articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:500', //حداکثر 500 کیلوبایت
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', //حداکثر 5 مگابایت
        ], [
            'file.max' => 'حجم فایل نباید بیشتر از 5 مگابایت باشد.',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $image = $validated['image'];
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $filename);
            $article->image = $filename;
        }
        if ($request->hasFile('file')) {
            $file = $validated['file'];
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/articles/files', $filename);
            $article->file = $filename;
        }

        $article->save();
        return redirect()->route('dashboard.my-articles.index')->with('success', 'مقاله با موفقیت ثبت شد و پس از بررسی و تایید ادمین، منتشر خواهد شد.');
    }



    public function edit($id)
    {
        $article = Article::findOrFail($id);

        if (auth()->id() === $article->user_id)
        {
            return view('dashboard.my-articles.edit', compact('article'));
        }

        return abort(403);
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|max:500', //حداکثر 500 کیلوبایت
            'remove_image' => 'sometimes|boolean',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120', //حداکثر 5 مگابایت
            'remove_file' => 'sometimes|boolean',
        ], [
            'file.max' => 'حجم فایل نباید بیشتر از 5 مگابایت باشد.',
        ]);

        $article->title = $validated['title'];
        $article->content = $validated['content'];

        if ($request->has('remove_image') && $article->image)
        {
            Storage::delete('public/articles/' . $article->image);
            $article->image = null;
        }
        if ($request->hasFile('image') && $request->missing('remove_image'))
        {
            if ($article->image) {
                Storage::delete('public/articles/' . $article->image);
            }
            $image = $validated['image'];
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/articles', $filename);
            $article->image = $filename;
        }


        if ($request->has('remove_file') && $article->file)
        {
            Storage::delete('public/articles/files/' . $article->file);
            $article->file = null;
        }
        if ($request->hasFile('file') && $request->missing('remove_file'))
        {
            if ($article->file) {
                Storage::delete('public/articles/files/' . $article->file);
            }
            $file = $validated['file'];
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/articles/files', $filename);
            $article->file = $filename;
        }

        $article->status = 'pending';

        $article->save();
        return redirect()->route('dashboard.my-articles.index')->with('success', 'مقاله با موفقیت ویرایش شد و پس از بررسی و تایید ادمین، منتشر خواهد شد.');
    }



    public function destroyOwnArticle($id)
    {
        $article = Article::findOrFail($id);

        if (auth()->id() === $article->user_id)
        {
            if ($article->image) {
                Storage::delete('public/articles/' . $article->image);
            }
            if ($article->file) {
                Storage::delete('public/articles/files/' . $article->file);
            }

            $article->delete();
            return back()->with('success', 'مقاله حذف شد.');
        }

        return abort(403);
    }
}
