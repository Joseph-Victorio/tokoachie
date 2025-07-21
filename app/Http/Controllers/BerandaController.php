<?php

namespace App\Http\Controllers;

use App\Models\ReviewPembeli;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request){
        $reviews = ReviewPembeli::all();

        return view('client.beranda', compact('reviews'));
    }
}
