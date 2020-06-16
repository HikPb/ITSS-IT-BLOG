<?php

namespace App\Http\Controllers;
use App\Comment;
use App\User;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index($id){
        $article = DB::table('articles')->where('id',$id)->first();
        $author = DB::table('users')->where('id',$article->user_id)->first();
        $comments = DB::table('comments')->join('users','comments.user_id','=','users.id')
            ->select('users.name', 'comments.content','comments.published_at')->get();

        return view('articles.index',['article'=>$article,'comments'=>$comments,'author'=>$author]);
    }

    public function comment(Request $request){
        $new_comment = new Comment();

        $new_comment->content = $request->text;
        $new_comment->article_id = 1;
        $new_comment->user_id = 1;
        $new_comment->published_at = "2020/07/14";
        $new_comment->save();
        return redirect()->back();
    }

    public function createNew(){

    }
}
