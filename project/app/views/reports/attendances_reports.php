<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Constants::TITLE ?> | Attendances Reports</title>
</head>

<body>
    <table cellpadding="10">
        <thead>
            <tr>
                <th>id</th>
                <th>user id</th>
                <th>employee name</th>
                <th>date</th>
                <th>check in</th>
                <th>check out</th>
                <th>total hours</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['reports'] as $report) { ?>
                <tr>
                    <td><?php echo $report['report_id']; ?></td>
                    <td><?php echo $report['user_id']; ?></td>
                    <td><?php echo $report['name']; ?></td>
                    <td><?php echo $report['date']; ?></td>
                    <td><?php echo $report['check_in']; ?></td>
                    <td><?php echo $report['check_out']; ?></td>
                    <td><?php echo $report['total_hours']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>