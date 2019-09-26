@extends('layouts.home')
@section('title', '新規投稿')
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <div class="border p-2">
         <h5 class="h5 mb-4">
           新規投稿
         </h5>
         <form action="{{ action('PostsController@create', ['group_id' => $group->id]) }}" method="post"
          enctype="multipart/form-data">
          @if (count($errors) > 0)
           <ul>
             @foreach($errors->all() as $e)
               <li>{{ $e }}</li>
             @endforeach
           </ul>
          @endif
          <fieldset class="mb-4">
            <div class="form-group">
              <label for="title">タイトル</label>
              <input type="text" class="form-control" name="title"
               value="{{ old('title') }}">
            </div>
            <div class="form-group">
              <label for="body">本文</label>
              <textarea class="form-control" name="body" rows="8">{{ old('body') }}</textarea>
            </div>
            <div class="mt-5">
              <a class="btn btn-secondary" href="{{ action('GroupController@index', ['id' => $group->id]) }}">キャンセル</a>
              {{ csrf_field() }}
              <input type="submit" class="btn btn-primary" value="投稿する">
            </div>
          </fieldset>
         </form>
        </div>
       </div>
      </div>
     </div>
 @endsection
