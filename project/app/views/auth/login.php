<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostafa | login</title>
</head>

<body>
    <form action="<?= Constants::BASE_URL . "login"?>"  method="post">
        <input type="hidden" name="csrf-token" value="<?= $data['csrf_token']; ?>">
        <label for="">Name:</label>
        <input type="text" name="Name" placeholder="userName...">
        <br>
        <label for="">password:</label>
        <input type="password" name="password" placeholder="password">
        <br>
        <button type="submit" name="login_button">login</button>
    </form>
</body>

</html>