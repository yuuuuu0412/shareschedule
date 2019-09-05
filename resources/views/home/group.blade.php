@extends('layouts.home')
@section('title', '{{ $group->name }}')
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <p>{{ $group->name }}</p>
       <p>グループID：{{ $group->id }}</p>
       <p>{{ $adminUser->name }}が作成したグループ</p>
     </div>
     <div class="row">
       <div class="col-md-8 mx-auto">
         <p>コンテンツ予定地</p>
       </div>
       <div class="col-md-4 mx-auto">
         <p>管理要素</p>

       </div>

     </div>
 @endsection
