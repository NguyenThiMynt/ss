@extends('layouts.main')
@section('title','会員管理')
@section('content')
    <div class="main-content">
        <div class="col-md-12 my-3">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <h3 class="title-tb">一ユーザー一覧</h3>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row" id="list_user">
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-sm btn-danger pull-left px-4 py-2" :disabled='isDisabled' @click="onclickDeleteUser()"><b>一括削除</b></button>
                        </div>
                        <div class="col-6">
                            <a href="{{route('user.create')}}" class="btn btn-sm btn-success pull-right mr-0 px-4 py-2"><b>会員登録</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 table-responsive">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cbx_delele_all" :checked="checkedAll" @change="checkedDeleteAllUser($event)">
                                    <label class="custom-control-label" for="cbx_delele_all"></label>
                                </div>
                            </th>
                            <th>性</th>
                            <th>名</th>
                            <th>メールアドレス</th>
                            <th>会員種別</th>
                            <th>登録日</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $itemuser)
                                <tr>
                            <td class="align-middle">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" :checked="checkedAll" class="custom-control-input cbox-deleted-user" @change="checkedDeleteUser($event)" id="cbx_delete_{{$itemuser->user_id}}" value="{{ $itemuser->user_id }}">
                                    <label class="custom-control-label" for="cbx_delete_{{$itemuser->user_id}}"></label>
                                </div>
                            </td>
                            <td class="align-middle">{{$itemuser->first_name}}</td>
                            <td class="align-middle">{{$itemuser->last_name}}</td>
                            <td class="align-middle w-30%">{{$itemuser->mail_address}}</td>
                            <td class="align-middle">{{ config('constant.role_text.'.$itemuser->role)}}</td>
                            <td class="align-middle">{{$itemuser->created_at->format('Y-m-d H:i')}}</td>
                            <td>
                                <a href="{{ route('user.edit', ['user_id' => $itemuser->user_id]) }}" class="btn-detail px-4 py-2">変更</a>
                            </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div>{{ $users->onEachSide(4)->links() }}</div>
        </div>
@endsection
@push('js')
    <script src="{{asset('js/user_profile.js')}}"></script>
@endpush