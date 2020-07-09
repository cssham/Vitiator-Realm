<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sliders = Slider::all();
        return response()->json([
            'sliders' => $sliders
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
        ]);
        /*
        //Image upload
        $image = $request->image;
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $request->name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check directory
            if(!file_exists('public/storage/item/')) {
                mkdir('public/storage/item/',0777,true);
            }
            //resize image
            //$postImage = Image::make($image)->resize(1600,1066)->save($imageName);

            //move image in directory
            $image->move('public/storage/item/',$imageName);
        }
        else{
            $imageName ='default.png';
        }
        */
        //image upload using vue
        $strpos = strpos($request->image, ';'); //position of semicolon
        $sub = substr($request->image, 0, $strpos); //string before semicolon
        $extension = explode('/', $sub)[1];
        $imageName = $request->name . time() . "." . $extension;
        $image = Image::make($request->image)->resize(1800, 991);
        $uploadPath = public_path() . "/storage/sliders/";
        $image->save($uploadPath . $imageName);

        $slider = new Slider();

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;

        $slider->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return response()->json([
            'slider' => $slider
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
        ]);

        //image upload using vue
        if ($request->image != $slider->image){
        $strpos = strpos($request->image, ';'); //position of semicolon
        $sub = substr($request->image, 0, $strpos); //string before semicolon
        $extension = explode('/', $sub)[1];
        $imageName = $request->name . time() . "." . $extension;
        $image = Image::make($request->image)->resize(1800, 991);
        $uploadPath = public_path() . "/storage/sliders/";
        $image->save($uploadPath . $imageName);

            $oldImage = $uploadPath . $slider->image;
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $image->save($uploadPath . $imageName);
        } else {
            $imageName = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;

        $slider->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $uploadPath = public_path() . "/storage/sliders/";
        $image =$uploadPath.$slider->image;
        if (file_exists($image)) {
            @unlink( $image);
        }
        $slider->delete();
    }
}
