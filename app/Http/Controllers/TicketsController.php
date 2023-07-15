<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->paginate(10);
        return response($tickets, 200);
    }

    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;

        $ticket->save();

        return response()->json(
            [
                "message" => "Berhasil mengirim tiket pesan",
                "ticket" => $ticket
            ],
            201
        );
    }
}
