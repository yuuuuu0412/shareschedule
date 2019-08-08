@extends('layouts.home')
@section('title', 'ホーム')
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-8 mx-auto">
       <h2>{{ Auth::user()->name }}のページ</h2>
     </div>
   </div>
 </div>
 @endsection
