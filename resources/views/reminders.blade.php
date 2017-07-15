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

    <form method="POST" action="/new">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="user">User:</label>
            <input type="text" id="user" name="user" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="when">DateTime:</label>
            <input type="text" id="when" name="when" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="reminder">Reminder:</label>
            <textarea id="reminder" name="reminder" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

    <hr/>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>When</th>
            <th>Reminder</th>
            <th>Reminded</th>
            <th>Canceled</th>
        </tr>
        @foreach ($reminders as $reminder)
            <tr>
                <td><a href="/{{ $reminder->id }}">{{ $reminder->id }}</a></td>
                <td>{{ $reminder->user }}</td>
                <td>{{ $reminder->when }}</td>
                <td>{{ $reminder->reminder }}</td>
                <td>{{ $reminder->remindedAt === null ? '' : 'yes' }}</td>
                <td>{{ $reminder->canceledAt === null ? '' : 'yes' }}</td>
            </tr>
        @endforeach
    </table>

</div>

</body>
</html>