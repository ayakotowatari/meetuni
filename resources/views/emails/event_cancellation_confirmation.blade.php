<!DOCTYPE html>
<html lang="en">
<style></style>
<body>

    <h1>Email</h1>
    <p>Dear {{ $student -> first_name }}, </p>
    <p>Booking Cancelled: </p>
    <p>{{ $event -> title }}</p>
    
</body>
</html>