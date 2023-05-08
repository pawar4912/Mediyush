<?php

namespace App\Http\Controllers\Admin;
use App\Models\Webinar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function getWebinar() {
        $webinar = Webinar::orderBy('id', 'DESC')->paginate(10);
        $webinar->withPath('/admin/webinar/list');
        return view('admin.webinar.list', compact('webinar'));
    }

    public function webinarAdd(Request $req) {
        $req->validate([
            'name' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $event = new Webinar();
        $event->name = $req->name;
        $event->venue = $req->venue;
        $event->description = $req->description;
        $event->price = $req->price;
        $imageName = time().'.'.$req->image->extension();  
        $req->image->move(public_path('webinar'), $imageName);
        $event->image = $imageName;
        $event->status = 1;
        $event->save();
        return redirect('admin/webinar/list')->with('success','Webinar added successfully !!!');
    }

    public function getEditWebinar($id) {
        $webinar = Webinar::find($id);
        return view('admin.webinar.edit', compact('webinar'));
    }

    public function editWebinar($id, Request $req) {
        $req->validate([
            'name' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $event = Webinar::find($id);
        $event->name = $req->name;
        $event->venue = $req->venue;
        $event->description = $req->description;
        $event->price = $req->price;
        if($req->image != ''){
            if($event->image != ''  && $event->image != null){
                 $file_old = public_path('webinar').'/'.$event->image;
                 unlink($file_old);
            }
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('webinar'), $imageName);
            $event->image = $imageName;
        }
        $event->update();
        return redirect('admin/webinar/list')->with('success','Webinar updated successfully !!!');
    }

    public function webinarActivate($id) {
        Webinar::where('id', $id)->update(["status" => 1]);
        return back()->with('success','Webinar activated successfully !!!');
    }

    public function webinarDeactivate($id) {
        Webinar::where('id', $id)->update(["status" => 0]);
        return back()->with('success','Webinar dectivated successfully !!!');
    }
}
