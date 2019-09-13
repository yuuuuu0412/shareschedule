@extends('layouts.home')
@section('title', $group->name)
@section('content')
 <div class="container">
   <div class="row">
     <div class="col-md-12 mx-auto">
       <table class="table table-bordered">
         <thead>
           <tr>
             <th width="20%">ID</th>
             <th width="80%">名前</th>
           </tr>
         </thead>
         <tbody>
           @foreach($members as $member)
           <tr>
             <td>{{ $member->id }}</td>
             <td>
               <div>
               <a href="{{ action('GroupController@delete_do', ['member_id' => $member->id, 'group_id' => $group->id]) }}">{{ $member->name }}</a>
              </div>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
  </div>
 @endsection
