<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function AllGallery(){
        $gallery = Gallery::latest()->get();
        return view('backend.gallery.all_gallery', compact('gallery'));
    }//End Method

    public function AddGallery(){
        return view('backend.gallery.add_gallery');
    }//End Method

    public function StoreGallery(Request $request){
        $images = $request->file('photo_name');

        foreach ($images as $img) {
            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('upload/gallery'), $name_gen);
            $save_url = 'upload/gallery/' . $name_gen;

            Gallery::insert([
                'photo_name' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } //end foreach

        $notification = array(
            'message' => 'Gallery Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gallery')->with($notification);


    }//End Method

    public function EditGallery($id){
        $gallery = Gallery::find($id);
        return view('backend.gallery.edit_gallery', compact('gallery'));
    }//end method

    public function UpdateGallery(Request $request){
        $gal_id = $request->id;
        $img = $request->file('photo_name');

        $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('upload/gallery'), $name_gen);
        $save_url = 'upload/gallery/' . $name_gen;

        Gallery::find($gal_id)->update([
            'photo_name' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Gallery updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.gallery')->with($notification);


    }//End Method

    public function DeleteGallery($id){
        $item = Gallery::findOrFail($id);
        $img = $item->photo_name;
        unlink($img);

        Gallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Gallery Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//End Method


}
