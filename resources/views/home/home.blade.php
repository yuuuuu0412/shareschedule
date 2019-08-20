@extends('layouts.home')
@section('title', 'ホーム')
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <h2>{{ Auth::user()->name }}のページ</h2>
       <p>作成したグループ</p>
       @foreach($admingroup as $group1)
        <a href="{{ action('HomeController@admingroup', ['id' => $group1->id]) }}">{{ $group1->name }}</a><br>
       @endforeach
       <p>参加中のグループ</p>
       <div class="row">
         <div class="col-md-8 mx-auto">
        <p>新しくグループを作成する</p>

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
         <label clas="col-md-2" for="name">グループ名</label>
         <div class="col-md-10">
           <input type="text" class="form-control" name="name"
            value="{{ old('name') }}">
         </div>
       </div>
       <input type="hidden" name="adminid" value="{{ Auth::id() }}">
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="作成">
       </form>
     </div>
   </div>
 </div>
 @endsection
