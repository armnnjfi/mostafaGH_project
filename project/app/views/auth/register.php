<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>

<body>
    <form action="register" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>">
        
        <label for="">Name:</label>
        <input type="text" name="name" placeholder="Name...">
        <br>

        <label for="">password:</label>
        <input type="password" name="password" placeholder="password">
        <br>

        <label>Email : </label>
        <input type="email" name="email" placeholder="Email">
        <br>

        <button type="submit" name="register_button">Register</button>
    </form>
</body>

</html>