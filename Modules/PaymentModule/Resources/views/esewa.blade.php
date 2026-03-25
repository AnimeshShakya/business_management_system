<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to eSewa</title>
</head>
<body>
<form id="esewa-payment-form" action="{{ $formAction }}" method="POST">
    @foreach($formData as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach

    <noscript>
        <p>Click the button below to continue payment with eSewa.</p>
        <button type="submit">Pay with eSewa</button>
    </noscript>
</form>

<script>
    document.getElementById('esewa-payment-form').submit();
</script>
</body>
</html>
