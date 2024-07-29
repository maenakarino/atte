@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="header__log">
    <p class="header__text">
        {{ \Auth::user()->name }}さんお疲れ様です！
    </p>
</div>

<div class="work__content">
    <form class="work-form" action="/work/start" method="post">
        @csrf
        <div class="work-form__item">
            @if(\Auth::user()->id || \Request::has('work_start'))
            <button class="form__item-button" type="submit" name="work_start">勤務開始</button>
            @else
            <button class="form__item-button" type="submit" name="work_start" disabled>勤務開始</button>
            @endif
        </div>
    </form>
    <form class="work-form" action="/work/end" method="post">
        @csrf
        <div class="work-form__item">
            @if(\Request::has('work_start') || \Request::has('rest_end'))
            <button class="form__item-button" type="submit" name="work_end">勤務終了</button>
            @else
            <button class="form__item-button" type="submit" name="work_end" disabled>勤務終了</button>
            @endif
        </div>
    </form>
</div>

<div class="rest__content">
    <form class="rest-form" action="rest/start" mathod="post">
        @csrf
        <div class="rest-form__item">
            @if(\Request::has('work_start') || \Request::has('rest_end'))
            <button class="form__item-button" type="submit" name="rest_start">休憩開始</button>
            @else
            <button class="form__item-button" type="submit" name="rest_start" disabled>休憩開始</button>
            @endif
        </div>
    </form>
    <form class="rest-form" action="rest/end" method="post">
        @csrf 
        <div class="rest-form__item">
            @if(\Request::has('rest_start'))
            <button class="form__item-button" type="submit" name="rest_end">休憩終了</button>
            @else
            <button class="form__item-button" type="submit" name="rest_end" disabled>休憩終了</button>
            @endif
        </div>
    </form>
</div>
@endsection