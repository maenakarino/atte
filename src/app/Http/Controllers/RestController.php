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
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        $user_id = Auth::user()->id;
        $confirm_date = Work::where('user_id', $user_id)
        ->where('date', $date)
        ->first();

        return view('index');
    }

    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = Carbon::now()->format('Y-m-d');

        if ($request->has('rest_start') || $request->has('rest_end')) {
            $work_id = Rest::where('user_id', $user_id)
                ->where('date', $date)
                ->first()
                ->id;
        }

        // 最新のrestレコードを取得
        $rest = Rest::where('user_id', $user_id)->where('date', $date)->first();

        // 休憩開始
        if ($request->has('rest_start')) {
            // レコードが存在するかチェック
            if ($rest) {
                $rest->start = $request->input('start', Carbon::now());
                $rest->end = $request->input('end', $rest->end);
                $rest->save();
            } else {
                return view('index');
            }
        } else {
            // 新しいrestレコードを作成
            $rest = Rest::create([
                'user_id' => $user_id,
                'date' => $date,
                'start' => Carbon::now(),
            ]);
        }

        $rest = $request->only(['start']);
        Rest::find($request->id)->update($rest);


        return view('/rest/update');
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
