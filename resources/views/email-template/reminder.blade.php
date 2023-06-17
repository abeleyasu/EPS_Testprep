<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reminder</title>
</head>
<body style="font-weight: 500; font-size: 17px;">
    <h2>Dear {{ $name }}</h2>
    <p>We hope you're doing well. This is your automated College Prep System Reminder, making sure you stay on top of your important deadlines and activities. </p>
    <p>Here's your reminder: <b>{{ $reminder_name }} - {{ $date }} at {{ $time }} ET.</p>
    <p>Staying organized is important in order to achieve your admissions and test goals. We're here to help you stay on track.</p>
    <p>If you have any questions or need assistance, feel free to contact our support team.</p>
    <p>Best of luck with your upcoming activities!</p>
    <p>Sincerely,</p>
    <p>College Prep System Team</p>
</body>
</html>