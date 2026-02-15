@extends('layouts.admin')
@section('title','Danh sách bài viết')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
    </div>
    @if(session('msg'))
    <div class="alert alert-message">
        {{ session('msg') }}
    </div>
    @endif
    <p><a href="{{route('admin.posts.add')}}" class="btn btn-primary">Thêm mới</a></p>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Tác giả</th>
            <th width="5%">Sửa</th>
            <th width="5%">Xóa</th>
        </tr>
    </thead>
    <tbody>
        {{-- Kiểm tra biến $list có tồn tại không trước khi vòng lặp --}}
        @if(isset($lists))
            @forelse($lists as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                   <td>{{!empty($item->postBy->name)?$item->postBy->name:false }}</td>
                    <td><a href="{{route('admin.posts.edit',$item->id)}}" class="btn btn-warning">Sửa</a></td>
                    <td>
                        @php
                            // Lấy quyền của nhóm người dùng đang đăng nhập
                            $permissions = json_decode(Auth::user()->group->permissions, true);
                        @endphp

                        {{-- Hiển thị nút xóa nếu người dùng là tác giả HOẶC có quyền xóa bài viết --}}
                        @if(Auth::id() === $item->user_id || isRole($permissions, 'posts', 'delete'))
                            <form method="POST" action="{{ route('admin.posts.delete', $item->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?');" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            @endforelse
        @else
            <tr>
                <td colspan="5" class="text-center text-danger">Lỗi: Biến $list chưa được truyền từ Controller</td>
            </tr>
        @endif
    </tbody>
   </table>
@endsection
