<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return response()->json([
            'contacts' => $contacts
        ],200);
    }
    public function delete($id){
        $contact = Contact::find($id);
        $contact->delete();
    }
}
