<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\News;

class NewsController extends Controller
{
    public function getNews(Request $request) {
        if ($request->ajax()) {
            $data = News::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($row){
       
                            $image ='<img src="/news/'. $row->image .'" heigth="150" width="150" alt="tag">';
      
                            return $image;
                    })
                    ->addColumn('action', function($row){
                        $btn ='<a href="/admin/news/edit/'.$row->id.'"
                        class="btn btn-secondary"><i class="ri-edit-2-line"></i></a>
                        <a href="/admin/news/delete/'.$row->id.'" class="btn btn-danger">
                        <i class="ri-delete-bin-5-line"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
        }
        return view('admin.news.list');
    }

    public function newsAdd(Request $req) {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $news = new News();
        $news->title = $req->title;
        $news->description = $req->description;
        $imageName = time().'.'.$req->image->extension();  
        $req->image->move(public_path('news'), $imageName);
        $news->image = $imageName;
        $news->save();
        return redirect('admin/news/list')->with('success','News added successfully !!!');
    }

    public function getEditNews($id) {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
    }

    public function editNews(Request $req, $id) {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $news = News::find($id);
        $news->title = $req->title;
        $news->description = $req->description;
        if($req->image != ''){  
            if($news->image != ''  && $news->image != null){
                 $file_old = public_path('news').'/'.$news->image;
                 unlink($file_old);
            }
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('news'), $imageName);
            $news->image = $imageName;
        }
        $news->update();
        return redirect('admin/news/list')->with('success','News updated successfully !!!');
    }

}
