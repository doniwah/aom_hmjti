<?php

namespace App\Http\Controllers;


use App\Models\postingan;
use App\Models\Ticket;
use App\Models\Sponsorships;
use Illuminate\Http\Request;
use App\Services\PostinganService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index(PostinganService $postinganService)
    {
        $postingans = postingan::orderBy("created_at", "desc")->take(9)->get();
        $ticket = Ticket::available()->with("ticket_benefit")->get();
        $dataSponsor = Sponsorships::all();
        return view('index', compact('postingans', 'ticket', 'dataSponsor'));
    }

    function sendMedpart()
    {
        return Redirect::away('https://wa.me/6281217126005');
    }
    function sendSponsorship()
    {
        return Redirect::away('https://wa.me/62881036457089');
    }
}
