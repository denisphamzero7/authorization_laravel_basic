<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    //
    public function index()
    {
        $lists = Groups::all();
        return view('admin.groups.list', compact('lists'));
    }
    public function add()
    {
        return  view('admin.groups.add');
    }
    public function postadd(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|unique:groups,name',
            ],
            [
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.unique' => 'Tên  trùng, vui lòng chọn lại',
            ]
        );
        $groups = new Groups();
        $groups->name = $request->name;
        // Gán giá trị cho trường 'description' để tránh lỗi SQL
        $groups->user_id = Auth::user()->id;
        $groups->description = $request->description ?? '';
        $groups->save();
        return redirect()->route('admin.groups.index')->with('msg', 'thêm thành công');
    }

    public function edit( Groups $group)
    {
        return  view('admin.groups.edit', compact('group'));
    }
    public function update(Request $request, Groups $group){
        $request->validate(
            [
                'name' => 'required|string|unique:groups,name',
            ],
            [
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.unique' => 'Tên  trùng, vui lòng chọn lại',
            ]
        );
        $group->name = $request->name;
        $group->group_id = $request->group_id;
        $group->save();
        return redirect()->route('admin.groups.index')->with('msg','Cập nhật nhóm thành công');
    }
    public function delete(Groups $group){

        $group->delete();
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm thành công.');
    }
}
