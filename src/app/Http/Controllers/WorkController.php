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
    $confirm_date = Work::where('user_id', $user_id)
    ->where('date', $date)
    ->first();
  
    if ($confirm_date) {
      return view('index');
    } else {
      return view('index');
    }

    if ($request->update) {
      return view('index');

    } else {
      return view('index');
    }

    if ($request->start) {
      return view('index');
    } else {
      return view('index');
    }

    if ($request->end) {
      return view('index');
    } else {
      return view('index');
    }

    
  }

  public function start(Request $request)
  {
    $date = Carbon::now()->format('Y-m-d');
    $user_id = Auth::user()->id;
    
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