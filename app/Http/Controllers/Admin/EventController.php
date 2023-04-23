<?php

namespace App\Http\Controllers\Admin;
use App\Models\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents() {
        $events = Event::orderBy('id', 'DESC')->paginate(10);
        $events->withPath('/admin/events/list');
        return view('admin.events.list', compact('events'));
    }

    public function eventAdd(Request $req) {
        $req->validate([
            'name' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $event = new Event();
        $event->name = $req->name;
        $event->venue = $req->venue;
        $event->description = $req->description;
        $event->price = $req->price;
        $imageName = time().'.'.$req->image->extension();  
        $req->image->move(public_path('events'), $imageName);
        $event->image = $imageName;
        $event->status = 1;
        $event->save();
        return redirect('admin/events/list')->with('success','Event added successfully !!!');
    }

    public function getEditEvent($id) {
        $event = Event::find($id);
        return view('admin.events.edit', compact('event'));
    }

    public function editEvent($id, Request $req) {
        $req->validate([
            'name' => 'required',
            'venue' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $event = Event::find($id);
        $event->name = $req->name;
        $event->venue = $req->venue;
        $event->description = $req->description;
        $event->price = $req->price;
        if($req->image != ''){
            if($event->image != ''  && $event->image != null){
                 $file_old = public_path('events').'/'.$event->image;
                 unlink($file_old);
            }
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('events'), $imageName);
            $event->image = $imageName;
        }
        $event->update();
        return redirect('admin/events/list')->with('success','Event updated successfully !!!');
    }

    public function eventActivate($id) {
        Event::where('id', $id)->update(["status" => 1]);
        return back()->with('success','Event activated successfully !!!');
    }

    public function eventDeactivate($id) {
        Event::where('id', $id)->update(["status" => 0]);
        return back()->with('success','Event dectivated successfully !!!');
    }
}
