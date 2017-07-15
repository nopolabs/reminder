<?php

namespace App\Http\Controllers;

use App\Reminder;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

class RemindersApiController extends Controller
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

    public function update(Reminder $reminder)
    {
        $data = RequestFacade::json()->all();

        $reminded = $data['reminded'] ?? false;
        $canceled = $data['canceled'] ?? false;

        if ($reminded && $canceled) {
            throw new Exception('must specify either reminded or canceled');
        }

        if ($reminded) {
            $reminder->remindedAt = new DateTime;
            $reminder->save();
        }

        if ($canceled) {
            $reminder->canceledAt = new DateTime;
            $reminder->save();
        }

        return Reminder::find($reminder->getId());
    }
}
