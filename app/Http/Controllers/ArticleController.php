<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->orderByDesc('created_at')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required_without:title_fr|max:255',
            'title_fr' => 'required_without:title_en|max:255',
            'content_en' => 'required_without:content_fr',
            'content_fr' => 'required_without:content_en',
        ]);

        Article::create([
            'title_en' => $request->title_en,
            'title_fr' => $request->title_fr,
            'content_en' => $request->content_en,
            'content_fr' => $request->content_fr,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('success', __('forum.article_created'));
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
    public function edit(Article $article)
    {
        $this->authorize('update', $article); // Uniquement l'auteur peut modifier l'article
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);
        $request->validate([
            'title_en' => 'required_without:title_fr|max:255',
            'title_fr' => 'required_without:title_en|max:255',
            'content_en' => 'required_without:content_fr',
            'content_fr' => 'required_without:content_en',
        ]);
        $article->update($request->only('title_en', 'title_fr', 'content_en', 'content_fr'));
        return redirect()->route('articles.index')->with('success', __('forum.article_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', __('forum.article_deleted'));
    }
}
