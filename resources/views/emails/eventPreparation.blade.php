<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CYTONN EVENTS PREPARATION NOTIFICATION</title>
</head>
<body>
<h3>Hello {{ $details['name'] }}</h3>
<p>
    Event {{ $details['eventName'] }} is coming up on {{ $details['eventDate'] }}
</p>
<p>To prepare for the events the following activities are required</p>
<ol>
    @foreach($details['activities'] as $activity)
        <li>{{$activity->description}}</li>
    @endforeach
</ol>
<hr>
<h4>Regards Cytonn Events System Admin</h4>
</body>
</html>

