<?php

namespace App\Http\Controllers\portal;
use App\Models\Job;
use App\Models\Job_Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class JobController extends Controller
{
  public function createJob(Request $req) {
    $req->validate([
        'userName' => 'required',
        'email' => 'required|email',
        'companyName' => 'required',
        'phoneNo' => 'required',
        'companywebsite' => 'required',
        'salary' => 'required',
        'experience' => 'required',
        'jobdesc' => 'required'
    ]);

    $job = new Job();
    $job->name = $req->userName;
    $job->email = $req->email;
    $job->company_name = $req->companyName;
    $job->phone_number = $req->phoneNo;
    $job->company_website = $req->companywebsite;
    $job->salary = $req->salary;
    $job->experience = $req->experience;
    $job->description = $req->jobdesc;
    $job->save();
    return back()->with('success','Job added successfully !!!');
  }

  public function viewJob(){
    $jobs=Job::where('status','1')->get();
    // dd($jobs);
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.job',compact('user', 'jobs'));
    } else {
      return view('portal.job',compact('jobs'));
    }
  }

  public function applyJob($id, Request $req){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();

      if ($user->cv === null || $user->experience === null || $user->skills === null || $user->qualification === null) {
        return back()->with('error','Update your profile!');
      }

      $job = new Job_Application();
      $job->userid = $user->id;
      $job->jobid = $id;
      $job->save();

      return back()->with('success','Application send Successfully !!!');
    } else {
      return redirect('/job')->withErrors('Please login first');
    }
  }
}
