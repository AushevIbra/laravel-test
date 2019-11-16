<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = Message::with([Message::WITH_MESSAGES, Message::WITH_USER])->where([
            [Message::ATTR_PARENT_ID, '=', null]
        ])->paginate(25);

        return view('home', ['messages' => $messages]);
    }
}
