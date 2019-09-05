@extends('layouts.home')
@section('title', '新たにグループに参加')
@section('content')
 <div class="container">
   <div class="row">
     @if (isset($message[0]))
      <p>{{$message}}</p>
     @endif
     </div>
     <div class="row">
     <form action="{{ action('ParticipantController@create') }}" method="post"
      enctype="multipart/form-data">
      @if (count($errors) > 0)
       <ul>
         @foreach($errors->all() as $e)
           <li>{{ $e }}</li>
         @endforeach
       </ul>
      @endif
     <div class="form-group row">
       <label clas="col-md-2" for="groupid">参加したいグループID</label>
       <div class="col-md-10">
         <input type="text" class="form-control" name="groupid"
          value="{{ old('groupid') }}">
       </div>
     </div>
     <div class="form-group row">
       <label clas="col-md-2" for="password">パスワード</label>
       <div class="col-md-10">
         <input type="text" class="form-control" name="password"
          value="{{ old('password') }}">
       </div>
     </div>
     <div class="form-group row">
       <div class="col-md-6">
     <input type="hidden" name="participants" value="{{ Auth::id() }}">
     {{ csrf_field() }}
     <input type="submit" class="btn btn-primary" value="参加">
     </div>
   </div>
   </div>
 </div>

 @endsection
