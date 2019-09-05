<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\Participant;
use App\User;
use Illuminate\Support\Facades\Log;
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
    public function index()
    {
      //ログイン中のユーザーIDを取得
      $id = \Auth::id();
      //ログインユーザーの作ったデータをすべて取得
      $admingroup = Group::where('adminid', $id)->get();
      //ログインユーザーのグループ参加記録をすべて取得し、それらのグループIDを抜き出す
      $participant = Participant::where('participants', $id)->pluck('groupid');
      if (isset($participant[0])) {
      //グループ参加記録に基づいて、参加中のグループをすべて取得
    Log::debug('デバッグメッセージ');
    Log::debug($participant);
    Log::debug('デバッグメッセージ2');
      $participantgroup = Group::whereIn('id', $participant)->get();
      }else {
      $participantgroup = array();
     }
      return view('home.home', ['admingroup' => $admingroup,
       'participantgroup' => $participantgroup]);
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
      return redirect('/home');
    }

    public function admingroup(Request $request)
    {
      $group = Group::find($request->id);
      return view('home.admingroup', ['group' => $group]);
    }

    public function participantgroup(Request $request)
    {
      $group = Group::find($request->id);
      return view('home.participantgroup', ['group' => $group]);
    }
}
