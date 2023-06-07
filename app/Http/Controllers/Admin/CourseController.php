<?php

namespace App\Http\Controllers\Admin;
use App\Models\Course;
use App\Models\PurchasedCourse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses() {
        $courses = Course::orderBy('id', 'DESC')->paginate(10);
        $courses->withPath('/admin/courses/list');
        return view('admin.courses.list', compact('courses'));
    }

    public function CourseAdd(Request $req) {
        $req->validate([
            'name' => 'required',
            'auther' => 'required',
            'description' => 'required',
            'original_price' => 'required',
            'price' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $course = new Course();
        $course->name = $req->name;
        $course->auther = $req->auther;
        $course->description = $req->description;
        $course->original_price = $req->original_price;
        $course->price = $req->price;
        $bannerName = time().'.'.$req->banner->extension();  
        $req->banner->move(public_path('courses'), $bannerName);
        $course->banner = $bannerName;
        $course->start_date = $req->start_date;
        $course->end_date = $req->end_date;
        $course->save();
        return redirect('admin/courses/list')->with('success','Course added successfully !!!');
    }

    public function getEditCourse($id) {
        $course = Course::find($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function editCourse(Request $req, $id) {
        $req->validate([
            'name' => 'required',
            'auther' => 'required',
            'description' => 'required',
            'price' => 'required',
            'original_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $course = Course::find($id);
        $course->name = $req->name;
        $course->auther = $req->auther;
        $course->description = $req->description;
        $course->price = $req->price;
        $course->original_price = $req->original_price;
        if($req->banner != ''){
            if($course->banner != ''  && $course->banner != null){
                 $file_old = public_path('courses').'/'.$course->banner;
                 unlink($file_old);
            }
            $bannerName = time().'.'.$req->banner->extension();  
            $req->banner->move(public_path('courses'), $bannerName);
            $course->banner = $bannerName;
        }
        $course->start_date = $req->start_date;
        $course->end_date = $req->end_date;
        $course->save();
        return redirect('admin/courses/list')->with('success','Course updated successfully !!!');
    }

    public function courseApplications($id, Request $request) {
        if ($request->ajax()) {
            $data = DB::table('purchased_courses')
                ->select('users.*')
                ->join('users', 'purchased_courses.userid', '=', 'users.id')
                ->where('purchased_courses.course_id',$id)
                ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('admin.courses.applications', compact('id'));
    }
}
