<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //

    public function index(){
        return "Danh sách bài viết";
    }

    public function add(){
        return "Thêm bài viết";
    }
}
