<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Participant;
use App\User;
use Illuminate\Support\Facades\Log;

class Groupcontroller extends Controller
{
    public function index(Request $request)
  {
    $group = Group::find($request->id);
    $adminUser = User::find($group->adminid);
    return view('home.group', ['group' => $group, 'adminUser' => $adminUser]);
  }
/*
  public function edit(Request $request);
  {
    //グループ管理者が自分のグループ名を変更する。
  }

  public function update(Request $request);
  {
    //変更したグループ名を更新保存する。
  }

  public function delete(Request $request);
  {
    //管理者であれば任意の参加者の、参加者であれば自分の参加資格を消去する。
  }

  public function destroy();
  {
    //管理者がグループそのものを消去する。
  }*/
}
