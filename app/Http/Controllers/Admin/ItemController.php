<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('category')->get();
        return response()->json([
            'items' => $items
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
      $this->validate($request,[
            'category_id'=>'required',
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            'offered_price'=>'required'
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
        $strpos = strpos($request->image,';'); //position of semicolon
        $sub = substr($request->image,0,$strpos); //string before semicolon
        $extension = explode('/',$sub)[1];
        $imageName = $request->name.time().".".$extension;
        $image =Image::make($request->image)->resize(370,320);
        $uploadPath = public_path()."/storage/items/";
        $image->save($uploadPath.$imageName);

        $item = new Item();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->image = $imageName;
        $item->short_description=$request->short_description;
        $item->long_description =$request->long_description;
        $item->price = $request->price;
        $item->offered_price=$request->offered_price;
        $item->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return response()->json([
            'item' => $item
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'price' => 'required',
            'offered_price' => 'required'
        ]);

        //image upload using vue
        if($request->image!=$item->image){

            $strpos = strpos($request->image, ';'); //position of semicolon
            $sub = substr($request->image, 0, $strpos); //string before semicolon
            $extension = explode('/', $sub)[1];
            $imageName = $request->name . time() . "." . $extension;
            $image = Image::make($request->image)->resize(370, 320);
            $uploadPath = public_path() . "/storage/items/";
            $oldImage = $uploadPath . $item->image;
            if (file_exists($oldImage)) {
                @unlink($oldImage);
            }
            $image->save($uploadPath . $imageName);
        }
      else {
          $imageName =$item->image;
      }


        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->image = $imageName;
        $item->short_description = $request->short_description;
        $item->long_description = $request->long_description;
        $item->price = $request->price;
        $item->offered_price = $request->offered_price;
        $item->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $uploadPath = public_path() . "/storage/items/";
        $image =$uploadPath.$item->image;
        if (file_exists($image)) {
            @unlink( $image);
        }
        $item->delete();
    }
}
