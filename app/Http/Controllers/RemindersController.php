<?php

namespace App\Http\Controllers;

use App\Reminder;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class RemindersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('user')) {
            $user = $request->get('user');

            return Reminder::where('user', $user)->get();
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

    public function reminded(Reminder $reminder)
    {
        $reminder->remindedAt = new DateTime;
        $reminder->save();

        return $reminder;
    }

    public function cancel(Reminder $reminder)
    {
        $reminder->canceledAt = new DateTime;
        $reminder->save();

        return $reminder;
    }

    public function update(Reminder $reminder)
    {
        $data = RequestFacade::json()->all();

        if (count($data) === 0) {
            throw new Exception('must specify remindedAt or canceledAt');
        }

        if (count($data) > 1) {
            throw new Exception('may only specify either remindedAt or canceledAt');
        }

        if (!isset($data['remindedAt']) && !isset($data['canceledAt'])) {
            throw new Exception('must specify either remindedAt or canceledAt');
        }

        if (isset($data['remindedAt'])) {
            $reminder->remindedAt = new DateTime;
        }

        if (isset($data['canceledAt'])) {
            $reminder->canceledAt = new DateTime;
        }

        $reminder->save();

        return $reminder;
    }
}
