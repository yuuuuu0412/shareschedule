@extends('layouts.home')
@section('title', $group->name)
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <p>{{ $group->name }}</p>
       <p>グループID：{{ $group->id }}</p>
       <p>{{ $adminUser->name }}が作成したグループ</p>
     </div>
     <div class="row">
       <div class="col-md-12 mx-auto">
         <p>コンテンツ予定地</p>
       </div>
       <div class="col-md-12 mx-auto">
         @if ($group->adminid == Auth::id())
         <a href="{{ action('GroupController@edit', ['id' => $group->id]) }}">グループ情報の管理</a><br>
         <a href="{{ action('GroupController@delete', ['id' => $group->id]) }}">グループメンバーの管理</a><br>
         <a href="{{ action('GroupController@destroy', ['id' => $group->id]) }}">グループの削除</a>
         @else
         <a href="{{ action('GroupController@delete', ['id' => $group->id]) }}">グループから脱退</a>
         @endif
       </div>
     </div>
 @endsection
