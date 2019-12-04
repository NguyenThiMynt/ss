@extends('layouts.main')
@section('title','チュートリアル')
@section('content')
    <div class="main-content">
        <div class="col-md-12 my-3">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <h3 class="title-tb">ブログ一覧</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-danger pull-left px-4 py-2"><b>一括削除</b></button>
                        </div>
                        <div class="col-6">
                            <a href="{{route('blogs.create')}}" class="btn btn-sm btn-success pull-right mr-0 px-4 py-2"><b>会員登録</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 table-responsive">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck"></label>
                                </div>
                            </th>
                            <th>タイトル</th>
                            <th>コンテンツ</th>
                            <th>登録日</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="align-middle">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"></label>
                                </div>
                            </td>
                            <td class="align-middle">タイトルタイトルタイトルタイ</td>
                            <td class="align-middle">コンテンツコンテンツコンテンツ</td>
                            <td class="align-middle">2019/11/12 22:20</td>
                            <td>
                                <button type="button" class="btn-detail px-3">変更</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2"></label>
                                </div>
                            </td>
                            <td class="align-middle">タイトルタイトルタイトルタイ</td>
                            <td class="align-middle">コンテンツコンテンツコンテンツ</td>
                            <td class="align-middle">2019/11/12 22:20</td>
                            <td>
                                <button type="button" class="btn-detail px-3">変更</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-middle">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3"></label>
                                </div>
                            </td>
                            <td class="align-middle">タイトルタイトルタイトルタイ</td>
                            <td class="align-middle">コンテンツコンテンツコンテンツ</td>
                            <td class="align-middle">2019/11/12 22:20</td>
                            <td>
                                <button type="button" class="btn-detail px-3">変更</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <ul class="pagination justify-content-center modal-1">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item "><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item "><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">30</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


