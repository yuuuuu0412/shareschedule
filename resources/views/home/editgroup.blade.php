@extends('layouts.home')
@section('title', $group->name)
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-12 mx-auto">
       <form action="{{ action('GroupController@update') }}" method="post" enctype="multipart/form-data">
         @if (count($errors) > 0)
          <ul>
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
          </ul>
        @endif
        @if ($message)
         <p>{{$message}}</p>
        @endif
        <div class="form-group row">
          <label for="name">変更後のグループ名を入力してください。（現在の名前：{{ $group->name }}）</label>
          <input type="text" class="form-control" name="name" value="{{ $group->name }}">
        </div>
        <div class="form-group row">
          <label for="name">現在のパスワードを入力してください。</label>
          <input type="text" class="form-control" name="current_password">
        </div>
        <div class="form-group row">
          <label for="name">パスワードを変更する場合は、変更後のパスワードを入力してください。</label>
          <input type="text" class="form-control" name="new_password">
        </div>
        <div class="form-group row">
          <input type="hidden" name="password" value="{{ $group->password }}">
          <input type="hidden" name="adminid" value="{{ $group->adminid }}">
          <input type="hidden" name="id" value="{{ $group->id }}">
       {{ csrf_field() }}
       <input type="submit" class="btn btn-primary" value="更新">
       </div>
      </form>
     </div>
   </div>
  </div>
 @endsection
