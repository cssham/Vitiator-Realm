<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        $categories = Category::all();
        $items = Item::all();
        $offers = Item::orderBy('offered_price','desc')->get();
        return view('frontend.index',compact('categories','items','offers','sliders'));

    }

}
