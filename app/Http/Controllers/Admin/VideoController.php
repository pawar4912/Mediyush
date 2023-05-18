<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use DataTables;

class VideoController extends Controller
{
    public function getVideos(Request $request) {
        if ($request->ajax()) {
            $data = Video::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='<a href="/admin/videos/edit/'.$row->id.'"
                        class="btn btn-primary"><i class="ri-edit-2-line"></i></a>
                        <a href="/admin/videos/delete/'.$row->id.'" class="btn btn-danger">
                        <i class="ri-delete-bin-4-line"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status_change', 'action'])
                    ->make(true);
        }
        return view('admin.videos.list');
    }

    public function videoAdd(Request $req) {
        $req->validate([
            'link' => 'required',
        ]);
        $video = new Video();
        $video->link = $req->link;
        $video->save();
        return redirect('admin/videos/list')->with('success','video added successfully !!!');
    }

    
    public function getEditVideo($id) {
        $video = Video::find($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function editVideo(Request $req, $id) {
        $req->validate([
            'link' => 'required',
        ]);
        $video = Video::find($id);
        $video->link = $req->link;
        $video->update();
        return redirect('admin/videos/list')->with('success','Video updated successfully !!!');
    }

    public function deleteVideo($id) {
        $video = Video::find($id);
        $video->delete();
        return redirect('admin/videos/list')->with('success','video deleted successfully !!!');
    }
}
