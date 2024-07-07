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
    return view('index');
  }

  public function start(Request $request)
  {
    $now_date = Carbon::now()->format('Y-m-d');
    $now_time = Carbon::now()->format('H:i:s');
    $user_id = Auth::user()->id;
    if ($request->has('start_rest') || $request->has('end_rest')) {
      $work_id = Work::where('user_id', $user_id)
      ->where('date', $now_date)
      ->first()
      ->id;
    }
    

    if ($request->has('start')) {
      $attendance = new Work();
      $attendance->date = $now_date;
      $attendance->start = $now_time;
      $attendance->user_id = $user_id;
    }

    return redirect('/work/start');
  }

  public function end(Request $request)
  {
    $user = Auth::user();

    if ($request->has('end')) {
      $attendance = Work::where('user_id', $user_id)
      ->where('date', $now_date)
      ->first();
      $attendance->end = $now_time;

    }

    return redirect('/work/end');
  }
}
