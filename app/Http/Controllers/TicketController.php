<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\TicketRequest;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Auth;
use function Psy\debug;

class TicketController extends Controller
{

    public function index()
    {
        if(Auth::user()->role === 'ADMIN') {
            $tickets = \DB::table('tickets')
                ->join('categories', 'tickets.category_id', '=', 'categories.id')
                ->select('tickets.uid', 'tickets.title', 'tickets.status', 'tickets.updated_at', 'categories.name')
                ->orderBy('tickets.status', 'asc')
                ->paginate(5);
            return view('tickets.index', ['tickets' => $tickets]);
        } else {
            $tickets = \DB::table('tickets')
                ->join('users', 'tickets.user_id', '=', 'users.id')
                ->join('categories', 'tickets.category_id', '=', 'categories.id')
                ->select('tickets.uid', 'tickets.title', 'tickets.status', 'tickets.updated_at', 'categories.name')
                ->where('users.id', '=', Auth::user()->id)
                ->orderBy('tickets.status', 'asc')
                ->paginate(5);
            return view('tickets.index', ['myTickets' => $tickets]);
        }
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', ['categories' => $categories]);
    }

    public function store(TicketRequest $request)
    {
        $uid = quickRandom();
        $user = User::find(Auth::user()->id);
        $category = Category::find($request->category);
        $ticket = new Ticket;
        $ticket->uid = $uid;
        $ticket->title = $request->title;
        $ticket->priority = $request->priority;
        $ticket->description = $request->description;
        $ticket->user_id = $user->id;
        $ticket->category_id = $category->id;
        $ticket->save();
        session(['message' => 'Ticket abierto exitosamente']);
        return redirect(route('ticket'));
    }

    public function show($uid)
    {
        $ticket = \DB::table('tickets')
            ->join('categories', 'tickets.category_id', '=', 'categories.id')
            ->select('tickets.uid', 'tickets.title', 'tickets.status', 'tickets.created_at', 'tickets.description', 'categories.name')
            ->where('tickets.uid', '=', $uid)
            ->first();

        return view('tickets.show', ['ticket' => $ticket]);
    }

    public function edit($id)
    {
        //
    }

    public function update($uid)
    {
        $ticket = Ticket::find($uid);
        $ticket->status = 'CLOSE';
        $ticket->save();
        session(['message' => 'Ticket cerrado exitosamente']);
        return redirect(route('ticket'));
    }

}
