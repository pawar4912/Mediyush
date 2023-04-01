<?php

namespace App\Http\Controllers\Admin;
use App\Models\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getJobs() {
        $jobs = Job::orderBy('id', 'DESC')->paginate(10);
        $jobs->withPath('/admin/jobs/list');
        return view('admin.jobs.list', compact('jobs'));
    }

    public function jobActivate($id) {
        Job::where('id', $id)->update(["status" => 1]);
        return back()->with('success','Job activated successfully !!!');
    }

    public function jobDeactivate($id) {
        Job::where('id', $id)->update(["status" => 0]);
        return back()->with('success','Job deactivated successfully !!!');
    }

    public function jobEdit($id, Request $req) {
        $job = Job::find($id);
        $job->name = $req->name;
        $job->email = $req->email;
        $job->company_name = $req->company_name;
        $job->phone_number = $req->phone_number;
        $job->company_website = $req->company_website;
        $job->salary = $req->salary;
        $job->experience = $req->experience;
        $job->description = $req->description;
        $job->update();
        return back()->with('success','Job edited successfully !!!');
    }
}
