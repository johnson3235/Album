<?php

namespace App\Http\Controllers;

use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorealbumRequest;
use App\Http\Requests\UpdatealbumRequest;
use App\Http\Requests\TransportDeleteAlbumRequest;

class AlbumController extends Controller
{

    public function createalbum()
    {
    
        return view('dashboard.albums.create');
    }


    public function viewalbum($id)
    {
        $album = DB::table('albums')->where('id', $id)->first();
        $pictures = DB::table('pictures')->where('album_id', $id)->get();
        return view('dashboard.albums.view', compact('album','pictures'));
    }


    public function editalbumPage($id)
    {
        $album = DB::table('albums')->where('id', $id)->first(); // object
        return view('dashboard.albums.edit', compact('album'));
    }


    public function storeInformationalbum(StoreAlbumRequest $request)
    {
        // upload image
        // $photoName = Media::upload($request->file('image'),'albums');
        $data = $request->safe()->except(['_token', 'image', 'submit']);
        // $data['image'] = $photoName;
        // insert into database
        DB::table('albums')->insert($data);
        // redirect => success message
        return redirect()->route('home')->with('success', 'Created Successfull');
    }

    public function updateInformationalbum(UpdateAlbumRequest $request, $id)
    {

        $album = DB::table('albums')->where('id', $id)->first();
        $data = $request->except('_token', '_method', 'submit');
        // // check if the request has photo=> upload new photo , delete old photo
        // if ($request->has('image')) {
        //     // upload image
        //     $newPhotoName = Media::upload($request->file('image'),'albums');
        //     // remove old photo
        //     Media::delete("images/albums/{$album->image}");

        //     $data['image'] = $newPhotoName;
        // }
        // update album into database
        DB::table('albums')->where('id', $id)->update($data);

        return redirect()->route('home')->with('success', 'Operation Successfull');
    }

    public function Deletealbum($id)
    {
        $album = DB::table('albums')->where('id', $id)->first();
        DB::table('albums')->where('id',$id)->delete();
        return redirect()->route('home')->with('success', 'Operation Successfull');
    }

    public function transportPage($id)
    {
        $album = DB::table('albums')->where('id', $id)->first();
        $newalbums=DB::table('albums')->get();
        return view('dashboard.albums.transport', compact('album','newalbums'));
    }


    public function transport(TransportDeleteAlbumRequest $request,$id)
    {
        $data = $request->except('_token', '_method', 'submit');
        $album = DB::table('albums')->where('id', $id)->first();
        DB::table('pictures')->where('album_id',$id)->update(['album_id' => $data['new_id']]);
        DB::table('albums')->where('id',$id)->delete();
        return redirect()->route('home')->with('success', 'Operation Successfull');
    }

}
