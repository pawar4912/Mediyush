<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GallaryPhoto;

class GallaryPhotosController extends Controller
{
    function getGallaryPhotos() {
        $gallaryPhotos = GallaryPhoto::orderBy('id', 'DESC')->paginate(10);
        $gallaryPhotos->withPath('/admin/gallary/list');
        return view('admin.gallary.list', compact('gallaryPhotos'));
    }

    public function gallaryPhotoAdd(Request $req) {
        $req->validate([
            'position' => 'required|unique:gallary_photos,position',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $gallaryPhoto = new GallaryPhoto();
        $gallaryPhoto->position = $req->position;
        $photoName = time().'.'.$req->photo->extension();  
        $req->photo->move(public_path('gallary_photos'), $photoName);
        $gallaryPhoto->photos = $photoName;
        $gallaryPhoto->save();
        return redirect('admin/gallary/list')->with('success','Gallary Photo added successfully !!!');
    }

    public function getEditGallaryPhoto($id) {
        $gallaryPhoto = GallaryPhoto::find($id);
        return view('admin.gallary.edit', compact('gallaryPhoto'));
    }

    public function editGallaryPhoto(Request $req, $id) {
        $req->validate([
            'position' => 'required|unique:gallary_photos,position,' . $id,
        ]);
        $gallaryPhoto = GallaryPhoto::find($id);
        $gallaryPhoto->position = $req->position;
        if($req->photo != ''){  
            if($gallaryPhoto->photos != ''  && $gallaryPhoto->photos != null){
                 $file_old = public_path('gallary_photos').'/'.$gallaryPhoto->photos;
                 unlink($file_old);
            }
            $imageName = time().'.'.$req->photo->extension();  
            $req->photo->move(public_path('gallary_photos'), $imageName);
            $gallaryPhoto->photos = $imageName;
        }
        $gallaryPhoto->update();
        return redirect('admin/gallary/list')->with('success','Gallary Photo updated successfully !!!');
    }

    public function deleteGallaryPhoto($id) {
        $gallaryPhoto = GallaryPhoto::find($id);
        $gallaryPhoto->delete();
        return redirect('admin/gallary/list')->with('success','Gallary Photo delete successfully !!!');
    }
}
