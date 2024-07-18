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
  
    if (!$confirm_date) {
      $status = 0;
    } else {
      $status = Auth::user()->status;
    }

    
    return view('index');
  }

  public function start(Request $request)
  {
    $date = Carbon::now()->format('Y-m-d');
    $now_time = Carbon::now()->format('H:i:s');
    $user_id = Auth::user()->id;
    $oldstart = Work::where('user_id', $user_id)->latest()->first();
    $oldDay = '';


    if ($request->has('start_time') || $request->has('end_time')) {
      $work_id = Work::where('user_id', $user_id)
      ->where('date', $date)
      ->first()
      ->id;
    }
    //勤務開始
    if ($request->has('start_time')) {
      $work = new Work();
      $work->date = $request->date;
      $work->start = $request->start ?? null;
      $work->end = $request->end ?? null;
      $work->user_id = $request->user();
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

  

  public function end(Request $request)
  {
    $user_id = Auth::user()->id;
    $date = Carbon::now()->format('Y-m-d');

    $oldend = Work::where('user_id',$user_id)->latest()->first();
    
    $work = Work::create([
      'user_id' => $user_id,
      'date' => $date,
      'end' => Carbon::now(),
    ]);

    //勤務終了
    if ($request->has('end_time')) {
      $work = Work::where('user_id', $user_id)
      ->where('date', $date)
      ->first();
      $work->end = $request->end ?? null;
      $work->start = $request->start ?? null;
      $status = 1;
    }
    

    

    return view('index');
  }
}