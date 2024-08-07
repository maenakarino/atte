<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\User;
use App\Models\Rest;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;

class WorkController extends Controller
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
  

  public function end(Request $request)
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
            } 
        } else {
            // 新しいWorkレコードを作成
            $work = Work::create([
                'user_id' => $user_id,
                'date' => $date,
                'end' => Carbon::now(),
            ]);
        }
        

        return redirect('/');
    }

    public function show(Request $request)
    {
      $displayDate = Carbon::now();

      $users = DB::table('works')
            ->whereDate('date', $displayDate)
            ->paginate(5);

      $displayDate = Carbon::parse($request->input('displayDate'));

      if ($request->has('prevDate')) {
            $displayDate->subDay();
        }

      if ($request->has('nextDate')) {
            $displayDate->addDay();
        }

      $displayUser = Auth::user()->name;
      $users = DB::table('users')
            ->where('name', $displayUser)
            ->paginate(5);
      $userList = User::all();

      $users = DB::table('works')->select('user_id', 'start', 'end', 'date')->get();
      $users = DB::table('users')->select('name')->get();

      $users = User::paginate(5);
      $displayDate = Carbon::now();

      return view('attendance',  compact('users', 'displayDate', 'displayUser', 'userList'));
    }

  
}