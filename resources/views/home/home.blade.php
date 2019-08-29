@extends('layouts.home')
@section('title', 'ホーム')
@section('content')
 <div class="container">
   <h2>{{ Auth::user()->name }}のページ</h2>
   <div class="row">
     <div class="col-md-6 mx-auto">
       <p>作成したグループ</p>
       @foreach($admingroup as $group1)
        <a href="{{ action('HomeController@admingroup', ['id' => $group1->id]) }}">{{ $group1->name }}</a><br>
       @endforeach
     </div>
      <div class="col-md-6 mx-auto">
       <p>参加中のグループ</p>
       @foreach($participantgroup as $group2)
        <a href="{{ action('HomeController@participantgroup', ['id' => $group2->id]) }}">{{ $group2->name }}</a><br>
       @endforeach
       <a href="{{ action('ParticipantController@index') }}">新たにグループに参加する</a>
     </div>
   </div>
       <div class="row">
         <div class="col-md-12">
        <p>新しくグループを作成する</p>
        <div class="row">
       <form action="{{ action('HomeController@create') }}" method="post"
        enctype="multipart/form-data">
        @if (count($errors) > 0)
         <ul>
           @foreach($errors->all() as $e)
             <li>{{ $e }}</li>
           @endforeach
         </ul>
        @endif
       <div class="form-group row">
         <label clas="col-md-2" for="name">グループ名　　</label>
         <div class="col-md-10">
           <input type="text" class="form-control" name="name"
            value="{{ old('name') }}">
         </div>
       </div>
       <div class="form-group row">
         <label clas="col-md-2" for="password">パスワード設定</label>
         <div class="col-md-10">
           <input type="text" class="form-control" name="password"
            value="{{ old('password') }}">
         </div>
       </div>
       <div class="form-group row">
         <div class="col-md-6">
       <input type="hidden" name="adminid" value="{{ Auth::id() }}">
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="作成">
       </div>
     </div>
     </div>
       </form>
       </div>
      </div>
      </div>
 @endsection
