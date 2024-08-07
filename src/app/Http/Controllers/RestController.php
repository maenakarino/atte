<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;

class RestController extends Controller
{

    public function start(Request $request)
    {
        
        $work_id = Work::work()->id;
        $date = Carbon::now()->format('Y-m-d');

        if ($request->has('rest_start') || $request->has('rest_end')) {
            $work_id = Rest::where('user_id', $user_id)
                ->where('date', $date)
                ->first()
                ->id;
        }
        
        // 最新のrestレコードを取得
        $rest = Rest::where('work_id', $work_id)->where('date', $date)->first();

        // 休憩開始
        if ($request->has('rest_start')) {
            $rest = new Rest();
            $rest->start = $date;
            $rest->work_id = $work_id;
        }

        return view('index');
    }

    public function end(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        

        //休憩終了
        if ($request->has('rest_end')) {
            $rest = Rest::where('work_id', $work_id)
                ->whereNotNull('start')
                ->whereNull('end')
                ->first();
            $rest->end = $now_time;
            $status = 3;
        }
        $user = User::find($user_id);
        $user->status = $status;
        $user->save();

        $rest->save();

        return view('index');
    }
}
