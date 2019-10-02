<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TimeLog;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::OrderBy('id', 'desc')->paginate(40);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->all());

        return redirect()
                ->route('users.index')
                ->with('alert', '新しいユーザーを作成しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        $user->load('timeLogs.project');




        $requestDate = new Carbon(\Request::input('date')) ?? Carbon::now();


//        $currentDate = Carbon::now();

//        dd($currentDate->format('d'));

        // ログを取得
        $timeLog = TimeLog::with('project')
            ->where('user_id', $user->id)
//            ->whereDay('start_at', $currentDate->format('Y-m-d'))
            ->whereDay('start_at', $requestDate)
            ->get();

        $users = User::all();

        return view('users.show', compact('user', 'users', 'timeLog', 'requestDate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // パスワードが入力されていない場合は項目を削除
        if ($request->password === null) {
            $request->request->remove('password');
        }

        $user->update($request->all());

        return redirect()
            ->route('users.index')
            ->with('alert', 'ユーザー情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('alert', 'ユーザーを削除しました。');
    }
}
