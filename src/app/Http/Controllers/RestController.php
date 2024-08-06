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


        // 最新のrestレコードを取得
        $rest = Rest::where('work_id', $work_id)->where('date', $date)->first();

        // 休憩開始
        if ($request->has('rest_start')) {
            // レコードが存在するかチェック
            if ($rest) {
                $rest->start = $request->input('start', Carbon::now());
                $rest->end = $request->input('end', $rest->end);
                $rest->save();
            } 
        } else {
            // 新しいWorkレコードを作成
            $rest = Rest::create([
                'work_id' => $work_id,
                'date' => $date,
                'start' => Carbon::now(),
            ]);
        }

        return view('index', compact('rest'));
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
