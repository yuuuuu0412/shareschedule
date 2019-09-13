<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Participant;
use App\User;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    public function index(Request $request)
  {
    $group = Group::find($request->id);
    $adminUser = User::find($group->adminid);
  //  Log::debug('デバッグメッセージ');
  //  Log::debug($participant);
  //  Log::debug('デバッグメッセージ2');
return view('home.group', ['group' => $group, 'adminUser' => $adminUser]);
  }

  public function edit(Request $request)
  {
    //グループ管理者が自分のグループ名を変更する。
    $group = Group::find($request->id);
    $message = "";
    return view('home.editgroup', ['group' => $group, 'message' => $message]);
  }

  public function update(Request $request)
  {
    //変更したグループ名を更新保存する。
    $this->validate($request, Group::$rules);
    $group = Group::find($request->id);
    if ($request->current_password != $request->password) {
      //入力されたパスワードが現在有効なパスワードと異なる場合
      return view('home.editgroup', ['group' => $group, 'message' => '現在有効なパスワードを入力してください。']);
    }
    $group->name = $request->name;
    if ($request->new_password) {
      //新しいパスワードが入力されている場合
      $group->password = $request->new_password;
    }
    $group->save();
    $adminUser = User::find($group->adminid);
    return view('home.group', ['group' => $group, 'adminUser' => $adminUser]);
  }

  public function delete(Request $request)
  {
    //管理者であれば任意の参加者の、参加者であれば自分の参加資格を消去する。
    $group = Group::find($request->id);
    $id = \Auth::id();
    $adminid = $group->adminid;
    if ($id == $adminid) {
    //もしログインユーザーがグループの管理者の場合
    $participants = Participant::where('groupid', $request->id)->pluck('participants');
    //このグループに関わる参加記録の中から、参加者のIDだけを抜き出した配列を取得する。
    $members = User::whereIn('id', $participants)->get();
    return view('home.delete', ['members' => $members, 'group' => $group]);
  }
    $del_participant = Participant::where('groupid', $request->id)->where('participants',$id);
    $del_participant->delete();
    return redirect('/home');
  }

  public function delete_do(Request $request)
  {
    $del_participant = Participant::where('groupid', $request->group_id)->where('participants', $request->member_id);
    $del_participant->delete();
    //indexに戻るための儀式
    $group = Group::find($request->group_id);
    $adminUser = User::find($group->adminid);
    return view('home.group', ['group' => $group, 'adminUser' => $adminUser]);
  }

  public function destroy(Request $request)
  {
    //管理者がグループそのものを消去する。
    $group = Group::find($request->id);
    $participant = Participant::where('groupid', $request->id);
    $participant->delete();
    $group->delete();
    return redirect('/home');
  }
}
