<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    // public function index()
    // {
    //     $clients = Client::paginate(10);
    //     return view('index', compact('clients'));
    // }

    public function indexjs()
    {
        return view('indexjs');
    }
    
    public function indexJson()
    {
        return Client::paginate(10);
    }

}
