@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-heading">
        <h1 class="content-title">商品登録</h1>
    </div>
    <form class="form" action="/products/register" method="post" enctype="multipart/form-data">
        @csrf
        <div class="input-txt">
            <div class="input-label">
                <p class="label-name">商品名</p>
                <p class="label-required">必須</p>
            </div>
            <input type="text" name="name" value="{{old('name')}}" placeholder="商品名を入力">
        </div>
        <div class="form-error">
            @error('name')
            {{ $message }}
        @enderror
        </div>
        <div class="input-txt">
            <div class="input-label">
                <p class="label-name">値段</p>
                <p class="label-required">必須</p>
            </div>
            <input type="text" name="price" value="{{old('price')}}" placeholder="値段を入力">
        </div>
        <div class="form-error">
            @error('price')
            {{ $message }}
            @enderror
        </div>
        <div class="input-img">
            <div class="input-label">
                <p class="label-name">商品名</p>
                <p class="label-required">必須</p>
                <p class="label-rule">複数選択可</p>
            </div>
            <input type="file" name="image" value="{{old('image')}}">
        </div>
        <div class="input-check">
            <div class="input-label">
                <p class="label-name">商品名</p>
                <p class="label-required">必須</p>
            </div>
            <div class="input-check__box">
                <input type="checkbox" name="season_id[]" value="1">春
                <input type="checkbox" name="season_id[]" value="2">夏
                <input type="checkbox" name="season_id[]" value="3">秋
                <input type="checkbox" name="season_id[]" value="4">冬
            </div>
            <div class="form__error">
                @error('season_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="input-area">
            <div class="input-label">
                <p class="label-name">商品説明</p>
                <p class="label-required">必須</p>
            </div>
            <textarea name="description" value="{{old('description')}}" placeholder="商品の説明を入力"></textarea>
        </div>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>
        <div class="form-button">
            <a class="form-button__back" href="/products">戻る</a>
            <button class="form-button__submit" type="submit" value="submit">登録</button>
        </div>
    </form>
</div>
@endsection