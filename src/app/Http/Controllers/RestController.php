<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestController extends Controller
{
    public function start(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $now_time = Carbon::now()->format('H:i:s');
        $user_id = Auth::user()->id;
        $oldstart = Rest::where('user_id', $user_id)->latest()->first();
        $oldDay = '';

        //休憩開始
        if ($request->has('start_time')) {
            $rest = new Rest();
        }
    }
}
