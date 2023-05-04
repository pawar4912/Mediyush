<?php

namespace App\Http\Controllers\Admin;
use App\Models\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class JobController extends Controller
{
    public function getJobs(Request $request) {
        if ($request->ajax()) {
            $data = Job::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status_change', function($row){
       
                            $btn =$row->status === 0 ? '<a href="/admin/jobs/activate/'.$row->id.'"
                            class="btn btn-success">Activate</a>' : ' <a href="/admin/jobs/deactivate/'.$row->id.'"
                            class="btn btn-danger">Deactivate</a>';
      
                            return $btn;
                    })
                    ->addColumn('action', function($row){
                        $btn ='<a href="/admin/jobs/edit/'.$row->id.'"
                        class="btn btn-secondary"><i class="ri-edit-2-line"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status_change', 'action'])
                    ->make(true);
        }
        return view('admin.jobs.list');
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
        return redirect('admin/jobs/list')->with('success','Job edited successfully !!!');
    }

    public function getJobForEdit($id) {
        $job = Job::find($id);
        return view('admin.jobs.edit', compact('job'));
    }
}
