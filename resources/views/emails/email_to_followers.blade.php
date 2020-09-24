<!DOCTYPE html>
<html lang="en">
<style></style>
<body>

    <h1>Email</h1>
    <p>Dear {{ $student -> first_name }}, </p>
    <p>{{ $inst_name }} has published a new event!</p>
    <p>{{ $event -> title }}</p>
    
</body>
</html>