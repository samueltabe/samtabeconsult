<?php

namespace App\Http\Controllers;

use App\Article;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
  
    public function index(){

        $articles = Article::latest()->take(4)->get();
        
        return view('articles.index',['articles'=>$articles]);
    }
   
    public function show($id){

         $article = Article::find($id);

         return view('articles.show', ['article'=>$article]);
    }


    public function create(){

        return view('articles.create');
    }

    
    public function store(){

        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');

        $article->save();

        return redirect('/articles');
    }


    public function edit($id){

        $article = Article::find($id);

        return view('articles.edit', ['article'=>$article]);
    }


    public function update(){


        request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
        ]);
 
        $article = new Article();
        $article->title = request('title');
        $article->excerpt = request('excerpt');
        $article->body = request('body');
        $article->save();

        return redirect('/articles/'. $article->id);
    }


}