@extends('layouts.layout')

@section('title')
<title>お問い合わせフォーム | VocaloList</title>
@endsection
@section('style')
<style>
        .row {
            padding: 10px 0;
        }
</style>
@endsection
@section('page_name')
<?php $page_name = 'contact'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('contact')}}
@endsection

@section('contents')
@if(isset($err))
<div class="row"><div class="col-12 text-danger">{{$err}}</div></div>
@elseif(isset($success))
<div class="row"><div class="col-12">{{'送信しました！'}}</div></div>
@endif
        <div class="row">
            <div class="col-12">
                <h2>お問い合わせ</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">「こんな機能が欲しい」「この動画入ってないよ」など、サイトに対する意見もお待ちしております。<br>送信は一日一回までです。24時にリセットされます。<br><br></div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <form action="{{route('contact')}}" method="POST">
                @csrf
                <div class="form-group">
                        <label for="name">名前orニックネーム　</label><span class="badge badge-secondary">任意</span>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス　</label><span class="badge badge-secondary">任意</span>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="contents">内容　</label><span class="badge badge-secondary">必須</span>
                        <textarea class="form-control" id="conntents" rows="3" name="content"></textarea>
                    </div>
                    <div class="d-none"><input type="text" name="is_not_bot"></div>
                    <button type="submit" class="btn btn-primary">送信</button>
                </form>
            </div>
        </div>
@endsection