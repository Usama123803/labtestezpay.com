<?php

namespace App\Http\Controllers;

use App\Timesheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function checkIn()
    {
        $authUser = Auth::guard('admin')->user();
        if($authUser){
            $timeSheet = new Timesheet();
            $timeSheet->check_in = Carbon::now();
            $timeSheet->user_id = $authUser->id;
            $timeSheet->created_at = Carbon::now();
            $timeSheet->save();
        }
        return redirect()->back();
    }

    public function checkOut()
    {
        $authUser = Auth::guard('admin')->user();
        $timesheet = Timesheet::whereDate('created_at', Carbon::today())->where('user_id',$authUser->id)->first();
        if($authUser && $timesheet){
            $timeSheet = Timesheet::find($timesheet->id);
            $timeSheet->check_out = Carbon::now();
            $timeSheet->updated_at = Carbon::now();
            $timeSheet->save();
        }
        return redirect()->back();
    }

    public function breakIn()
    {
        $authUser = Auth::guard('admin')->user();
        $timesheet = Timesheet::whereDate('created_at', Carbon::today())->where('user_id',$authUser->id)->first();
        if($authUser && $timesheet){
            $timeSheet = Timesheet::find($timesheet->id);
            $timeSheet->break_in = Carbon::now();
            $timeSheet->updated_at = Carbon::now();
            $timeSheet->save();
        }
        return redirect()->back();
    }

    public function breakOut()
    {
        $authUser = Auth::guard('admin')->user();
        $timesheet = Timesheet::whereDate('created_at', Carbon::today())->where('user_id',$authUser->id)->first();
        if($authUser && $timesheet){
            $timeSheet = Timesheet::find($timesheet->id);
            $timeSheet->break_out = Carbon::now();
            $timeSheet->updated_at = Carbon::now();
            $timeSheet->save();
        }
        return redirect()->back();
    }
}
