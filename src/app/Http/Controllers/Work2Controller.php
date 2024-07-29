<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;

class Work2Controller extends Controller
{
    // ホーム画面表示
    public function index2()
    {
        $date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $confirm_date = Work::where('user_id', $user_id)
            ->where('date', $date)->latest()
            ->first();

        if ($confirm_date) {
            $status = 0;
            return view('index2');
        } else {
            
        }
        return view('index2', compact('status'));
    }


    // 打刻処理
    public function start(Request $request)
    {
        $now_date = Carbon::now()->format('Y-m-d');
        $now_time = Carbon::now()->format('H:i:s');
        $user_id = Auth::user()->id;
        if ($request->has('rest_start') || $request->has('rest_end')) {
            $work_id = Work::where('user_id', $user_id)
                ->where('date', $now_date)
                ->first()
                ->id;
        }

        // 勤務開始
        if ($request->has('work_start')) {
            $work = new Work();
            $work->date = $now_date;
            $work->start = $now_time;
            $work->user_id = $user_id;
            $status = 1;
        }

        // 休憩開始
        if ($request->has('rest_start')) {
            $rest = new Rest();
            $rest->start = $now_time;
            $rest->work_id = $work_id;
            $status = 2;
        }

        // 休憩終了
        if ($request->has('rest_end')) {
            $rest = Rest::where('work_id', $work_id)
                ->whereNotNull('start')
                ->whereNull('end')
                ->first();
            $rest->end = $now_time;
            $status = 1;
        }

        // 勤務終了
        if ($request->has('work_end')) {
            $work = Work::where('user_id', $user_id)
                ->where('date', $now_date)
                ->first();
            $work->end = $now_time;
            $status = 3;
        }

        $user = User::find($user_id);
        $user->status = $status;
        $user->save();

        $work->save();

        return redirect('/')->with(compact('status'));
    }

}
