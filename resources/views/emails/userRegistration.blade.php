<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CYTONN EVENTS SYSTEM REGISTRATION</title>
</head>
<body>
<h3>Hello {{ $details['name'] }}</h3>
<p>
    You are receiving this email to confirm to
    confirm that you  successfully been registered in the Cytonn Events System
</p>
<h4>Please use the following details to Login into the System</h4>

<h2><b>Email : </b> {{ $details['email'] }} </h2>
<h2><b>Password : </b> {{ $details['password'] }} </h2>
<hr>
<h4>Regards Cytonn Events System Admin</h4>
</body>
</html>
