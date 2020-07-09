<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::all();
        return response()->json([
            'reservations' => $reservations
        ],200);
    }
    public function status($id){
        $reservation = Reservation::find($id);
        $reservation->status =true;
        $reservation->save();
    }
    public function delete($id)
    {
        $reservation = Reservation::find($id);

        $reservation->delete();
    }
}
