<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>no company employee | <?= Constants::TITLE; ?></title>
</head>

<body>
    <form action="<?= Constants::BASE_URL ?>setCompanyForEmp" method="post">
    <input type="hidden" name="csrf_token" value="<?= $data['csrf_token'] ?>">
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>email</th>
                <th>Appointment of</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['noCompanyEmp'] as $noCompanyEmp) { ?>
                <tr>
                    <td><?= $noCompanyEmp['id']; ?></td>
                    <td><?= $noCompanyEmp['name']; ?></td>
                    <td><?= $noCompanyEmp['email']; ?></td>
                    <td>
                        <select name="company_id[<?= $noCompanyEmp['id']; ?>]" >
                            <option value="" disabled selected>یک شرکت انتخاب کنید</option>
                            <?php foreach ($data['companies'] as $company) { ?>
                                <option value="<?= $company['id']; ?>"><?= $company['name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <button type="submit">ذخیره</button>
</form>
</body>

</html>