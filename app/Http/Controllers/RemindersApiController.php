<?php

namespace App\Http\Controllers;

use App\Reminder;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RemindersApiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('user')) {
            $user = $request->get('user');

            return Reminder::where('user', $user)
                ->whereNull('canceledAt')
                ->whereNull('remindedAt')
                ->get();
        }

        if ($request->has('remind')) {
            $now = new DateTime();
            return Reminder::where('when', '<', $now)
                ->whereNull('canceledAt')
                ->whereNull('remindedAt')
                ->get();
        }

        return Reminder::all();
    }

    public function store(Request $request)
    {
        $params = $request->json()->all();

        Log::debug("STORE: ".json_encode($params));

        return Reminder::create($params);
    }

    public function show(Reminder $reminder)
    {
        return $reminder;
    }

    public function update(Request $request)
    {
        $params = $request->json()->all();

        Log::debug("STORE: ".json_encode($params));

        if (!isset($params['id'])) {
            return ['error' => 'no id'];
        }

        $reminderId = $params['id'];
        $reminder = Reminder::find($reminderId);

        if (!$reminder) {
            return ['error' => "$reminderId not found"];
        }

        $reminded = $params['reminded'] ?? false;
        $canceled = $params['canceled'] ?? false;

        if (!$reminded && !$canceled) {
            return $reminder;
        }

        if ($reminded) {
            $reminder->remindedAt = new DateTime;
        }

        if ($canceled) {
            $reminder->canceledAt = new DateTime;
        }

        $reminder->save();

        return Reminder::find($reminderId);
    }
}
