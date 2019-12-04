@extends('layouts.main')
@section('title','会員管理')
@section('content')
    <form action="{{route('user.post.create')}}" method="post" enctype="multipart/form-data" class="f-form" id="form_register_user">

        <div class="col-md-12 mb-2">
            <div class="row">
                <h3 class="title-tb mt-3">一ユーザー登録・変更</h3>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ $data ? $data->user_id : '' }}">
        <div class="form-group">
            <label>性</label>
            <input type="text" class="form-control" id="first_name" value="{{ $data ? $data->first_name : '' }}" name="first_name">
            <p class="first_name_error text-danger"></p>
        </div>
        <div class="form-group">
            <label>名</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data ? $data->last_name : '' }}">
            <p class="last_name_error text-danger"></p>
        </div>
        <div class="form-group">
            <labe>メールアドレス</labe>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data ? $data->mail_address : '' }}">
            <p class="email_error text-danger"></p>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
            <p class="password_error text-danger"></p>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck" name="isAdmin" @if($data && $data->role == config('constant.role.admin')) checked @endif>
            <label class="custom-control-label" for="customCheck">管理者として登録</label>
        </div>
        <div class="col-12 mt-4 text-center">
            <a href="{{route('user.index')}}" class="btn btn-light py-2 btn-cancel">キャンセル</a>
            <button type="button" class="btn btn-success py-2 ml-5 btn-create" @click="onclickSaveUser()">保存</button>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{asset('js/user_profile.js')}}"></script>
@endpush
