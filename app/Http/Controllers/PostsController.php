<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Participant;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
  public function new(Request $request)
  {
    $group = Group::find($request->id);
    return view('posts.posts_create', ['group' => $group]);
  }
  public function create(Request $request)
  {
    $this->validate($request, Post::$rules);
    $post = new Post;
    $form = $request->all();
    unset($form['_token']);
    $post->fill($form);
    $post->save();
    $group = Group::find($request->group_id);
    $adminUser = User::find($group->adminid);
    $posts = Post::where('group_id', $request->group_id)->orderBy('created_at', 'desc')->get();
   return view('home.group', ['group' => $group, 'adminUser' => $adminUser, 'posts' => $posts]);
  }
}
