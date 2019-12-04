@extends('layouts.main')
@section('title','お知らせ管理')
@section('content')
    <form method="post" enctype="multipart/form-data" class="f-form w-form" id="form_notification">
        <div class="col-md-12 mb-2">
            <div class="row">
                    <h3 class="title-tb mt-3">お知らせ登録・変更</h3>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ $data ? $data->notification_id : '' }}">
        <div class="form-group" id="">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title_notification">
            <p class="title_notification_error text-danger"></p>
        </div>
        <div class="form-group">
            <label for="comment">コンテンツ</label>
            <div id = "editortext" runat = "server"></div>
            <textarea class="form-control" rows="5" cols="30" name="txt_notification" id="txt_notification"></textarea>
        </div>
        <div class="col-12 mt-4 text-center">
            <button type="submit" class="btn btn-light py-2 btn-cancel">キャンセル</button>
            <button type="button" class="btn btn-success py-2 ml-5 btn-create" @click="onclickSaveNotification()">保存</button>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{asset('js/notification.js')}}"></script>
    <script>
        CKEDITOR.replace('txt_notification', { toolbar: 'Basic' });
        var t = "<%=editortext.InnerText %>";
        CKEDITOR.instances.txt_notification.setData(t);
    </script>
@endpush