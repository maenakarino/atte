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
    $today = Carbon::today();
    $month = intval($today->month);
    $day = intval($today->day);

    $items = Work::GetMonthAttendance($month)->GetDayAttendance($day)->get();
    return view('index');
  }

  public function start(Request $request)
  {
    $date = Carbon::now()->format('Y-m-d');
    $now_time = Carbon::now()->format('H:i:s');
    $user_id = Auth::user()->id;

    $oldstart = Work::where('user_id',$user_id)->latest()->first();

    $oldDay = '';
    
    

    if ($oldstart) {
      $oldWorkstart = new Carbon($oldstart->start);
      $oldDay = $oldWorkstart->startOfDay();
    }
    $today = Carbon::today();

    if(($oldDay == $today) && (empty($oldstart->end))) {
      return redirect()->back()->with('message','出勤打刻済みです');
    }

    if($oldstart) {
      $oldWorkend = new Carbon($oldstart->end);
      $oldDay = $oldWorkend->startOfDay();
    }

    if(($oldDay == $today)) {
      return redirect()->back()->with('message','退勤打刻済みです');
    }

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

    return view('index');
  }
}