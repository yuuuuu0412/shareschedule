<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\Participant;
use App\User;

class ParticipantController extends Controller
{
  public function index()
  {
    return view('home.participant');
  }

  public function create(Request $request)
  {
    $this->validate($request, Participant::$rules); //バリデーション
    $group = Group::where('id', $request->groupid)->get();//参加希望のグループを取得
    if ($group == null) {
      //参加希望のグループが存在しない場合
      return view('home.participant', ['message' => 'グループIDかパスワードが違います。')
    }else {
      if ($request->password != $group->password) {
        //入力パスワードと参加希望グループのパスワードが一致しない場合
        return view('home.participant', ['message' => 'グループIDかパスワードが違います。')
      }else {
          $participant = New participant;
          $form = $request->all();
          unset($form['_token']);
          $participant->fill($form)->save();
          return view(home.home)
      }
    }
  }
}
