@extends('layouts.home')
@section('title', '{{ $group->name }}')
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <p>{{ $group->name }}</p>
       <p>{{ Auth::user()->name }}が作成したグループ</p>
     </div>
 @endsection
