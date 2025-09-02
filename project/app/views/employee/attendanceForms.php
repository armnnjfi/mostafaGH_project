<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance | <?= Constants::TITLE ?></title>
</head>

<body><br>
    <form action="<?= Constants::BASE_URL ?>submit_Attendance" method="post" enctype="multipart/form-data">

        <?php if ($_SESSION['attendance'] == 0) { ?>
            <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>">
            <label for="date">Date : </label>
            <input type="date" name="data" id="date"><br>

            <label for="entryTime">entry time : </label>
            <input type="time" name="entryTime" id="entryTime"><br>

            <label for="entryPic">Enter a Picture : </label>
            <input type="file" name="entryPic" id="entryPic"><br>

        <?php } else { ?>
            <label for="exitTime">exit time : </label>
            <input type="hidden" name="csrf_token" value="<?= $data['csrf_token']; ?>">
            <input type="time" name="exitTime" id="exitTime"><br>
        <?php } ?>
        <input type="submit" value="ارسال">
    </form>
</body>

</html>