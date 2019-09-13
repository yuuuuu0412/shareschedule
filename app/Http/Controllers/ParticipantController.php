<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\Participant;
use App\User;
use Illuminate\Support\Facades\Log;

class ParticipantController extends Controller
{
  public function index()
  {
    return view('home.participant');
  }

  public function create(Request $request)
  {
    $this->validate($request, Participant::$rules); //バリデーション
    $id = \Auth::id();//ログインユーザーのIDの取得
    $group = Group::where('id', $request->groupid)->first();//参加希望のグループを取得
    //Log::debug('デバッグメッセージ');
    //Log::debug($group);
    //Log::debug('デバッグメッセージ2');
    if (empty($group)) {
      //検索したグループが存在しない場合
      $message = '検索したグループは存在しません。';
      return view('home.participant', ['message' => $message]);
    }
    if ($group->adminid == $id)
    {
      //ログインユーザーがグループの作成者の場合
      $message = '自分が作成したグループには参加できません。ホーム画面から管理画面に移動できます。';
      return view('home.participant', ['message' => $message]);
    }
    $participant = Participant::where('groupid', $request->groupid)->where('participants', $id)->get();
    //参加希望グループにログインユーザーが参加した記録を取得
    if (isset($participant[0]))
    {
      //参加記録が存在する場合
      $message = 'あなたはすでにそのグループに参加しています。';
      return view('home.participant', ['message' => $message]);
    }
    if (empty($group) || $request->password != $group->password)
     {
    //参加希望のグループが存在しない、または入力パスワードと参加希望グループのパスワードが一致しない場合
    $message = 'グループIDかパスワードが違います。';
      return view('home.participant', ['message' => $message]);
    }
          $participant = new Participant;
          $form = $request->all();
          unset($form['_token']);
          $participant->fill($form);
          $participant->save();
          return redirect('/home');
      }
    }
