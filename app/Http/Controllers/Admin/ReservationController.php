<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\ReservationConfirmation;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

        Notification::route('mail',$reservation->email)
        ->notify(new ReservationConfirmation());
    }
    public function delete($id)
    {
        $reservation = Reservation::find($id);

        $reservation->delete();
    }
}
