@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="user">
            <div class="panel w50 centered">
                <h3 class="panel-title">作業時間の登録</h3>
                <form class="form is-horizontal" method="POST" action="{{ route('reports.store') }}">
                    @csrf
                    @include('reports.fields')
                </form>
            </div>
        </div>
    </div>
@endsection
