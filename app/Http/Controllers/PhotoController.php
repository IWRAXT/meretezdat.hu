<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $imageName = $image->getClientOriginalName();
//        $image->move(public_path('images'),$imageName);

        if ($request->hasFile('foto')) {

            $photo=new Photo();
            $photo->name='ponty.jpg';

            $path = $request->file('foto')->storeAs('public/images', $photo->name);
            $img = Image::make(storage_path('app/'.$path))
                ->resize(100, 100)
                ->save();


            //  $img = Image::make($path)->resize(100, 100)->save();

            //return $request->foto->extension();   --Megadja a file kiterjesztését
            //return Storage::putFile('public',$request->file('foto')); --upload1
            // return

            // $request->foto->storeAs('public/images','ponty.jpg');  //--upload2
            //$request->foto->storeAs('public/images', 'pontyresize.jpg'); //--upload3 -ponty-néven


            //$url=Storage::url('ponty.jpg');
            //dd($img);

            $photo->save();
            return view('welcome');
        } else {
            return redirect('/')->with('success','Nincs file kiválasztva');
        }


    }



    public function upload(Request $request)
    {





        if ($request->hasFile('file')) {

            $photo=new Photo();
            $photo->name='ponty.jpg';

            $path = $request->file('file')->storeAs('public/images', $photo->name);
            $img = Image::make(storage_path('app/'.$path))
                ->resize(100, 100)
                ->save();
            $photo->save();
            return redirect('/')->with('success','Working on upload');
        } else {
            return redirect('/')->with('success','Nincs file kiválasztva');
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
