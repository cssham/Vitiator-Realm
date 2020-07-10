<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Contact;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalOrders = Reservation::where('status', 0)->count();
        $totalCategories = Category::count();
        $totalItems = Item::count();
        $totalMessage = Contact::count();
        $requests = Reservation::where('status',0)->get();
        return response()->json([
            'totalOrders'=>$totalOrders,
            'totalCategories'=>$totalCategories,
            'totalItems'=>$totalItems,
            'totalMessage'=>$totalMessage,
            'requests'=>$requests
        ],200);
    }
}
