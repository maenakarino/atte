@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="header__log">
    <p class="header__text">
        〇〇さんお疲れ様です！
    </p>
</div>

<div class="work__content">
    <form class="work-form" action="{{ route('work/start') }}" method="post">
        @csrf
        <div class="work-form__item">
            <button class="form__item-button" type="submit" name="work-start">勤務開始</button>
        </div>
    </form>
    <form class="work-form" action="{{ route('work/end') }}" method="post">
        @csrf
        <div class="work-form__item">
            <button class="form__item-button" type="submit" name="work-end">勤務終了</button>
        </div>
    </form>
</div>

<div class="break__content">
    <form class="break-form" action="{{ route('break/start') }}" mathod="post">
        @csrf
        <div class="break-form__item">
            <button class="form__item-button" type="submit" name="break-start">休憩開始</button>
        </div>
    </form>
    <form class="break-form" action="{{ route('break/end') }}" method="post">
        @csrf 
        <div class="break-form__item">
            <button class="form__item-button" type="submit" name="break/end">休憩終了</button>
        </div>
    </form>
@endsection