@extends('layouts.main')
@section('title','チュートリアル')
@section('content')
    <form action="#" method="post" enctype="multipart/form-data" class="f-form w-form ">
        <div class="col-md-12 mb-2">
            <div class="row">
                    <h3 class="title-tb mt-3">ブログ登録・変更</h3>
            </div>
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" placeholder="">
        </div>
        <div class="form-group">
            <label for="comment">コンテンツ</label>
            <textarea class="form-control" rows="5" cols="30"></textarea>
        </div>
        <div class="col-md-12 blog-detail">
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="pull-right">プレビュー</a>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4 text-center">
            <button type="button" class="btn btn-light py-2 btn-cancel">キャンセル</button>
            <button type="button" class="btn btn-success py-2 ml-5 btn-create">保存</button>
        </div>
    </form>
@endsection
