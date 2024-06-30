<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    public function index()
  {
    return view('index');
  }

  public function start(Request $request)
  {
    $user = Auth::user();
    

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
