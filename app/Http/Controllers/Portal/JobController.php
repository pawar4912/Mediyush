<?php

namespace App\Http\Controllers\portal;
use App\Models\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
