<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;

class GroupsController extends Controller
{
    //
    public function index(){
        $lists = Groups::all();
        return view('admin.groups.list', compact('lists'));
    }
    public function add(){
        return "Thêm nhóm";
    }
}
