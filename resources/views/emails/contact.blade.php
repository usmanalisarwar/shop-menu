<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>
  <h3>You have a new message from your website contact form</h3>

<p><strong>Name:</strong> {{ $name }}</p>
<p><strong>Email:</strong> {{ $email }}</p>
<p><strong>Subject:</strong> {{ $subject }}</p>
<p><strong>Message:</strong></p>
<p>{{ $userMessage }}</p> <!-- Changed 'message' to 'userMessage' -->
</body>
</html>
