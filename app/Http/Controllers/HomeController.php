<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\User;

class HomeController extends Controller
{
    /*
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
      //ログイン中のユーザーIDを取得
      $id = \Auth::id();
      //ログインユーザーの作ったデータをすべて取得
      $admingroup = Group::where('adminid', $id)->get();
    //  if ($admingroup == null) {
    //    $admingroup = '';
      return view('home.home', ['admingroup' => $admingroup]);
      }

    public function create(Request $request)
    {
      $this->validate($request, Group::$rules);
      $group = new Group;
      $form = $request->all();
      unset($form['_token']);
      $group->fill($form);
      /*$group->adminid =  Auth::user()->id;*/
      $group->save();
      //ログイン中のユーザーIDを取得
      $id = \Auth::id();
      //ログインユーザーの作ったデータをすべて取得
      $admingroup = Group::where('adminid', $id)->get();
      return redirect('home');
    }
    public function admingroup(Request $request)
    {
      $group = Group::find($request->id);
      return view('home.admingroup', ['group' => $group]);
    }
}
