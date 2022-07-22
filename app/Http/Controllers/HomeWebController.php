<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permit;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use function view;

class HomeWebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $details = [
//            'title' => 'Mail from ItSolutionStuff.com',
//            'body' => 'This is for testing email using smtp'
//        ];
//
//        Mail::to("hanen.he.essa@gmail.com")->send(new \App\Mail\MyTestMail($details));
//
//        dd("Email is Sent.");
//
        return view('home');
    }
}
