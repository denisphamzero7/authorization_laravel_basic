<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    //
    public function index(){
        return "Danh sách nhóm";
    }
    public function add(){
        return "Thêm nhóm";
    }
}
