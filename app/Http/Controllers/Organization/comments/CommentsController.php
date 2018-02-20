<?php

namespace App\Http\Controllers\Organization\comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Comment;
use Session;
class CommentsController extends Controller
{
    public function postComment(Request $request){
        $model = new Comment;
        $model->fill($request->except(['_token']));
        $model->save();
        Session::flash('success','Comment posted successfully!');
        return back();
    }
}
