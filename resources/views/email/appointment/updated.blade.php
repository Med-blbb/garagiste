<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Updated</title>
</head>
<body>
    <h1>Appointment Updated</h1>
    <p>The appointment details for {{ $clientName }} have been updated:</p>
    <ul>
        <li>Status: {{ $appointment->status }}</li>
        <li>Date: {{ $appointment->date }}</li>
        <li>Time: {{ $appointment->time }}</li>
        <li>Client ID: {{ $appointment->user_id }}</li>
    </ul>
</body>
</html>
