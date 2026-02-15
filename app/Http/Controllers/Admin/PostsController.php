<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //

    public function index(){
        $lists = Post::all();
        return view('admin.posts.list',compact('lists'));
    }

    public function add(){
        return "Thêm bài viết";
    }
    public function postadd(){
        return "Thêm bài viết";
    }
    public function edit(){
        return "Thêm bài viết";
    }
    public function postedit(){
        return "Thêm bài viết";
    }
    public function delete(){
        return "Thêm bài viết";
    }

}
