<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getAdminPage(){
        return view('backend.beranda');
    }

    public function getOwnerPage(){
        return view('owner.beranda');
    }

    public function getPelanggan(){
        return view('backend.pelanggan.home');
    }
}
