@extends('layouts.main')
@section('title','カレンダー')
@section('content')
    <div class="main-content">
            <div class="col-12 my-3">
                <div class="row">
                    <div class="col-6 mt-3">
                        <h3 class="title-tb">Agenda</h3>
                    </div>
                    <div class="col-6 mt-3">
                        <a href="{{route('calendar.create')}}" class="btn-agenda pull-right px-3 py-1">カレンダー</a>
                    </div>
                </div>
            </div>
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>イベント名</th>
                    <th>カラー</th>
                    <th>カテゴリー</th>
                    <th>開催日時</th>
                    <th>主催者</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="align-middle">Women’s Vintage Peacoat</td>
                    <td class="align-middle"></td>
                    <td class="align-middle">FX</td>
                    <td class="align-middle">2019/11/12 22:20</td>
                    <td>管理者</td>
                </tr>
                <tr>
                    <td class="align-middle">Women’s Vintage Peacoat</td>
                    <td class="align-middle"></td>
                    <td class="align-middle">FX</td>
                    <td class="align-middle">2019/11/12 22:20</td>
                    <td class="align-middle">管理者</td>
                </tr>
                <tr>
                    <td class="align-middle">Women’s Vintage Peacoat</td>
                    <td class="align-middle"></td>
                    <td class="align-middle">FX</td>
                    <td class="align-middle">2019/11/12 22:20</td>
                    <td class="align-middle">管理者</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

