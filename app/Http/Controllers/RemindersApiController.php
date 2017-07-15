<?php

namespace App\Http\Controllers;

use App\Reminder;
use DateTime;
use Illuminate\Http\Request;

class RemindersApiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('user')) {
            $user = $request->get('user');

            return Reminder::where('user', $user)->get();
        }

        if ($request->has('remind')) {
            $now = new DateTime();
            return Reminder::where('when', '<', $now)->get();
        }

        return Reminder::all();
    }

    public function store(Request $request)
    {
        return Reminder::create($request->json()->all());
    }

    public function show(Reminder $reminder)
    {
        return $reminder;
    }

    public function cancel(Request $request)
    {
        $params = $request->json()->all();

        if (!isset($params['id'])) {
            return ['error' => 'no id'];
        }

        $reminderId = $params['id'];
        $reminder = Reminder::find($reminderId);

        if (!$reminder) {
            return ['error' => "$reminderId not found"];
        }

        $reminder->canceledAt = new DateTime;
        $reminder->save();

        return Reminder::find($reminderId);
    }

    public function reminded(Request $request)
    {
        $params = $request->json()->all();

        if (!isset($params['id'])) {
            return ['error' => 'no id'];
        }

        $reminderId = $params['id'];
        $reminder = Reminder::find($reminderId);

        if (!$reminder) {
            return ['error' => "$reminderId not found"];
        }

        $reminder->remindedAt = new DateTime;
        $reminder->save();

        return Reminder::find($reminderId);
    }
}
