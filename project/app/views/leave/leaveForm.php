<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeaveForm | <?= Constants::TITLE ?></title>
</head>

<body>
    <form action="<?= Constants::BASE_URL . "leave_form"?>"  method="post">
        <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>">
        <label for="">start Date :</label>
        <input type="date" name="start_date">
        <br>
        <label for="">end Date :</label>
        <input type="date" name="end_date">
        <br>
        <label for="">Reason :</label>
        <textarea name="reason" name="reason"></textarea>
        <br>
        <button type="submit" name="submit">send</button>
    </form>
</body>

</html>