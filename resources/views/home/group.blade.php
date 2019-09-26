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
       <div class="col-md-12">
       <div class="mb-4">
         <a href="{{ action('PostsController@new', ['id' => $group->id]) }}">新規投稿</a>
       </div>
     </div>
     <div class="row">
       <div class="col-md-12 mx-auto">
         @if ($posts)
          @foreach($posts as $post)
           <div class="card mb-4">
             <div class="card-header">
               {{ $post->title }}
             </div>
             <div class="card-body">
               <p class="card-text">
                {{ str_limit($post->body, 200) }}
               </p>
             </div>
             <div class="card-footer">
               <span class="mr-2">
                 投稿日時 {{ $post->created_at->format('Y.m.d') }}
               </span>
             </div>
             @if ($post->comments->count())
             <span class="badge badge-primary">
                コメント {{ $post->comments->count() }}
             </span>
             @endif
           </div>
          @endforeach
         @endif
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
   </div>
 </div>
 @endsection
