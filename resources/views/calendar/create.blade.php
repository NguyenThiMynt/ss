@extends('layouts.main')
@section('title','カレンダー')
@section('content')
    <div class="main-content">
        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4 mt-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link px-3 py-2" href="#">Today</a></li>
                            <li class="page-item"><a class="page-link" href="#">Back</a></li>
                            <li class="page-item"><a class="page-link px-3 py-2" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-4 text-center mt-4">
                    <h3 class="calendar-title">2019年1月</h3>
                </div>
                <div class="col-4 mt-3">
                    <a href="{{route('calendar.index')}}" class="btn-agenda pull-right mr-0 px-4 py-2">Agenda</a>
                </div>
            </div>
        </div>
    </div>
@endsection
