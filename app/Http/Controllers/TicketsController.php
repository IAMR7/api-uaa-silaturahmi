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

    public function detail($id)
    {
        $ticket = Ticket::with('user')->find($id);
        return response($ticket, 200);
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

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $ticket->title = $request->title;
        $ticket->message = $request->message;
        $ticket->status = $request->status;
        $ticket->user_id = $request->user_id;

        $ticket->save();

        return response()->json(
            [
                "message" => "Berhasil mengubah tiket pesan",
                "ticket" => $ticket
            ],
            201
        );
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        $ticket->delete();

        return response()->json(
            [
                "message" => "Berhasil menghapus tiket pesan",
                "ticket" => $ticket
            ],
            201
        );
    }
}
