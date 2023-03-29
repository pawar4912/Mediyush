<?php

namespace App\Http\Controllers\Admin;
use App\Models\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getJobs() {
        $jobs = Job::paginate(1);
        $jobs->withPath('/admin/jobs/list');
        return view('admin.jobs.list', compact('jobs'));
    }
}
