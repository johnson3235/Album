<?php

namespace App\Http\Controllers;

use App\Traits\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\UpdatePictureRequest;

class PictureController extends Controller
{

    public function index()
    {
        $pictures = DB::table('pictures')->join('albums', 'pictures.album_id', '=', 'albums.id')->select('pictures.*',DB::raw('albums.name as album_name'))->get();
        
        return view('dashboard.pictures.index',compact('pictures'));
    }

    public function createpicture()
    {
        $albums = DB::table('albums')->get();
        return view('dashboard.pictures.create',compact('albums'));
    }


    public function editpicturePage($id)
    {
        $picture = DB::table('pictures')->where('id', $id)->first(); // object
        $albums = DB::table('albums')->get();
        return view('dashboard.pictures.edit', compact('picture','albums'));
    }


    public function storeInformationpicture(StorePictureRequest $request)
    {
        // upload image
        $photoName = Media::upload($request->file('src'),'pictures');
        $data = $request->safe()->except(['_token', 'src', 'submit']);
        $data['src'] = $photoName;
        // insert into database
        DB::table('pictures')->insert($data);
        // redirect => success message
        return redirect()->route('picture.home')->with('success', 'Created Successfull');
    }

    public function updateInformationpicture(UpdatePictureRequest $request, $id)
    {

        $picture = DB::table('pictures')->where('id', $id)->first();
        $data = $request->except('_token', '_method', 'submit');
        if ($request->has('src')) {

            $newPhotoName = Media::upload($request->file('src'),'pictures');
            Media::delete("images/pictures/{$picture->src}");

            $data['src'] = $newPhotoName;
        }
        // update picture into database
        DB::table('pictures')->where('id', $id)->update($data);
        return redirect()->route('picture.home')->with('success', 'Operation Successfull');
    }

    public function Deletepicture($id)
    {
        $picture = DB::table('pictures')->where('id', $id)->first();
        DB::table('pictures')->where('id',$id)->delete();
        return redirect()->back()->with('success', 'Operation Successfull');
    }

}
