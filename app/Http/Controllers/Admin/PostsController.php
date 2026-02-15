<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //

    public function index(){
        $lists = Post::latest()->get();
        return view('admin.posts.list',compact('lists'));
    }

    public function add(){
        return view('admin.posts.add');
    }
    public function postadd(Request $request){
         $request -> validate(
                [
                    'title' => 'required|string',
                    'content' => 'required|string',

                ],[
                    'title.required' => 'Trường :attribute bắt buộc phải nhập',
                    'title.string' => 'Trường :attribute không hợp lệ',
                    'content.required' => 'Trường :attribute bắt buộc phải nhập',
                    'content.string' =>'Trường :attribute không hợp lệ',

                ]
            );
         $post = new Post();
         $post->title=$request->title;
         $post->content=$request->content;
         $post->user_id= Auth::user()->id;
         $post->save();
         return redirect()->route('admin.posts.index')->with('msg','thêm thành công');

    }
    public function edit(Request $request, Post $post){
        return view('admin.posts.edit', compact('post'));
    }
    public function postedit(Request $request, Post $post){
        $request -> validate(
                [
                    'title' => 'required|string',
                    'content' => 'required|string',

                ],[
                    'title.required' => 'Trường :attribute bắt buộc phải nhập',
                    'title.string' => 'Trường :attribute không hợp lệ',
                    'content.required' => 'Trường :attribute bắt buộc phải nhập',
                    'content.string' =>'Trường :attribute không hợp lệ',

                ]
            );
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
        return redirect()->route('admin.posts.index')->with('msg','Cập nhật thành công');
    }
    public function delete(Post $post){

        // Lấy quyền của nhóm người dùng đang đăng nhập
        $permissions = json_decode(Auth::user()->group->permissions, true);

        // Kiểm tra xem người dùng có phải là tác giả HOẶC có quyền xóa bài viết không
        if (Auth::id() !== $post->user_id && !isRole($permissions, 'posts', 'delete')) {
            return redirect()->route('admin.posts.index')->with('msg', 'Bạn không có quyền xóa bài viết này!');
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('msg', 'Xóa bài viết thành công.');
    }

}
