<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company | Mostafa</title>
</head>
<body>
    <form action="<?= Constants::BASE_URL?>add_company" method="post">
        <label for="companyName">Name :</label>
        <input type="text" id="companyName" name="companyName"><br><br>
        <input type="submit" value="ثبت شرکت جدید">
    </form>
</body>
</html>