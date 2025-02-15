<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array{
        return [
            new Middleware('permission:view article', only:['article_index']),
            new Middleware('permission:create article', only:['article_create']),
            new Middleware('permission:edit article', only:['article_edit']),
            // new Middleware('premission:view article', only:['article_index']),
        ];
    }



    public function article_index(){

        $articles=Article::orderBy('id','DESC')->get();
        return view('backend.article.index',['articles'=>$articles]);
    }

    public function article_create(){
        return view('backend.article.create');
    }

    public function article_store(Request $request){
        $request->validate([
            'title'=>'required|min:5|max:255',
            'author'=>'required|min:5|max:255'
        ]);

        $article=Article::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'author'=>$request->author
        ]);

        if($article){
            return redirect()->route('article.index')->with('success','article added!');
        }else{
            return redirect()->route('article.index')->with('errror','article not added');
        }
    }

    public function article_edit($id){
        $article=Article::find($id);
        return view('backend.article.edit',['article'=>$article]);
    }

    public function article_update(Request $request,$id){
        $request->validate([
            'title'=>'required|min:5|max:255',
            'author'=>'required|min:5|max:255'
        ]);

        $article=Article::where('id',$id)->update(['title'=>$request->title,'author'=>$request->author]);
        if($article){
            return redirect()->route('article.index')->with('success','article updated!');
        }else{
            return redirect()->route('article.index')->with('errror','article not updated');
        }
    }
}
