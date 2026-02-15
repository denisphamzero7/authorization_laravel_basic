<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use  App\Models\Modules;
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
                'name' => 'required|string|unique:groups,name,'.$group->id,
            ],
            [
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.unique' => 'Tên nhóm đã tồn tại, vui lòng chọn lại',
            ]
        );
        $group->name = $request->name;
        $group->description = $request->description ?? '';
        $group->save();
        return redirect()->route('admin.groups.index')->with('msg','Cập nhật nhóm thành công');
    }
    public function delete(Groups $group){

        $group->delete();
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm thành công.');
    }
    public function permission(Groups $group){

        $modules = Modules::all();
        $roleListArray =[
            'view'=>'Xem',
            'add'=>'Thêm',
            'edit'=>'Sửa',
            'delete'=>'Xóa',
        ];

        $roleArr = [];
        if (!empty($group->permissions)) {
            $roleArr = json_decode($group->permissions, true);

        }

        return view('admin.groups.permission', compact('group', 'modules', 'roleListArray', 'roleArr'));
    }
    public function postpermission(Request $request,Groups $group){
        if(!empty($request->role)){
            $roleArr= $request->role;
        }
         else{
            $roleArr=[];
         }
         $roleJson =json_encode($roleArr);
         $group->permissions = $roleJson;
         $group->save();
         return back()->with('msg','Cập nhật thành công');
    }
}
