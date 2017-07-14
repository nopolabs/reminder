<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/app.css" rel="stylesheet" type="text/css" />
    <title>Reminders</title>
</head>
<body>

<div class="container">

    <p><a href="/"><- reminders</a></p>

    <h3>Reminder {{ $reminder->id }}</h3>

    <div>User: {{ $reminder->user }}</div>
    <div>When: {{ $reminder->when }}</div>
    <div>Reminder: {{ $reminder->reminder }}</div>
    @if ($reminder->remindedAt)
        <div>RemindedAt: {{ $reminder->remindedAt }}</div>
    @endif
    @if ($reminder->canceledAt)
        <div>CanceledAt: {{ $reminder->canceledAt }}</div>
    @else
        <form method="POST" action="/{{ $reminder->id }}">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <input name="id" type="hidden" value="{{ $reminder->id }}">
            <div class="form-group">
                <button type="submit" name="cancel" value="cancel" class="btn btn-primary">Cancel</button>
            </div>
        </form>
    @endif

</div>

</body>
</html>