<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>no company employee | <?= Constants::TITLE; ?></title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php //foreach ($data['user'] as $user) { ?>
                <tr>
                    <!-- <td><?php //echo $user['id']; ?></td>
                    <td><?php //echo $user['name']; ?></td>
                    <td><?php //echo $user['role']; ?></td>
                    <td><?php //echo $user['email']; ?></td>
                    <td><a href="http://localhost/sina%20project/mvc/project/admin/userPromote?userId=<?php //echo $user['id'] ?>"><button>promote to admin</button></a></td>
                    <?php //if ($user['id'] != '5') { ?>
                        <td><a href="http://localhost/sina%20project/mvc/project/admin/adminToUser?userId=<?php //echo $user['id'] ?>"><button>to user</button></a></td>
                    <?php // } ?> -->

                </tr>
            <?php //} ?>
        </tbody>
    </table>
</body>

</html>