<?php

namespace App\Http\Controllers;

use App\Reminder;
use DateTime;
use Illuminate\Http\Request;

class RemindersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('user')) {
            $user = $request->get('user');
            $reminders = Reminder::where('user', $user)->get();
        } else {
            $reminders = Reminder::all();
        }

        return view('reminders', ['reminders' => $reminders]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'when' => 'required',
            'reminder' => 'required',
        ]);

        $reminder = Reminder::create($request->all());

        return view('reminder', ['reminder' => $reminder]);
    }

    public function show(Reminder $reminder)
    {
        return view('reminder', ['reminder' => $reminder]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        if ($request->has('cancel')) {
            $reminder = Reminder::find($id);
            $reminder->canceledAt = new DateTime;
            $reminder->save();
        }

        $reminder = Reminder::find($id);

        return view('reminder', ['reminder' => $reminder]);
    }
}
