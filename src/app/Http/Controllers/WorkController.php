<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;

class WorkController extends Controller
{
    public function index()
  {
    $date = Carbon::now()->format('Y-m-d');
    $user_id = Auth::user()->id;
    $status = Auth::user()->status;
    $confirm_date = Work::where('user_id', $user_id)
    ->where('date', $date)
    ->first();
  
    if (!$confirm_date) {
      $status = 0;
    } else {
      $status = Auth::user()->status;
    }

    
    return view('index', compact('status'));
  }

  public function start(Request $request)
  {
    $date = Carbon::now()->format('Y-m-d');
    $now_time = Carbon::now()->format('H:i:s');
    $user_id = Auth::user()->id;
    $oldstart = Work::where('user_id', $user_id)->latest()->first();
    $oldDay = '';


    if ($request->has('rest_start') || $request->has('rest_end')) {
      $work_id = Work::where('user_id', $user_id)
      ->where('date', $date)
      ->first()
      ->id;
    }
    //勤務開始
    if ($request->has('work_start')) {
      $work = new Work();
      $work->date = $request->date;
      $work->start = $now_time;
      $work->end = $now_time;
      $work->user_id = $user_id;
      $status = 1;
    }

    $today = Carbon::today();
    

    $month = intval($today->month);
    $day = intval($today->day);
    $year = intval($today->year);

    $work = Work::create([
      'user_id' => $user_id,
      'date' => $date,
      'start' => Carbon::now(),
    ]);

    return view('index');
  }
  

  public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = Carbon::now()->format('Y-m-d');

        // 最新のWorkレコードを取得
        $work = Work::where('user_id', $user_id)->where('date', $date)->first();

        // 勤務終了
        if ($request->has('work_end')) {
            // レコードが存在するかチェック
            if ($work) {
                $work->end = $request->input('end', Carbon::now());
                $work->start = $request->input('start', $work->start);
                $work->save();
                $status = 2;
            } else {
                return response()->json(['message' => 'Work record not found'], 404);
            }
        } else {
            // 新しいWorkレコードを作成
            $work = Work::create([
                'user_id' => $user_id,
                'date' => $date,
                'end' => Carbon::now(),
            ]);
        }

        $user = User::find($user_id);
        $user->save();


        return redirect('/');
    }

  
}