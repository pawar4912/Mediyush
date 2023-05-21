<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use DataTables;

class FeedbackController extends Controller
{
    public function getFeedbacks(Request $request) {
        if ($request->ajax()) {
            $data = User::select('feedback.*', 'users.first_name', 'users.last_name')->join('feedback', 'feedback.userid', '=', 'users.id')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_name', function($row){
                        return $row->first_name ." ". $row->last_name;
                    })
                    ->addColumn('action', function($row){
                        if(!$row->status) {
                            $btn ='<a href="/admin/feedbacks/approve/'.$row->id.'"
                            class="btn btn-primary"><i class="bi bi-check-circle"></i></a>';
                            return $btn;
                        }
                        $btn ='<a href="/admin/feedbacks/delete/'.$row->id.'" class="btn btn-danger">
                        <i class="ri-delete-bin-4-line"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status_change', 'action'])
                    ->make(true);
        }
        return view('admin.feedbacks.list');
    }

    public function deleteFeedback($id) {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect()->back()->with('success','Feedback delete successfully !!!');
    }

    public function approveFeedback($id) {
        $feedback = Feedback::find($id);
        $feedback->status = 1;
        $feedback->update();
        return redirect()->back()->with('success','Feedback approved successfully !!!');
    }
}
