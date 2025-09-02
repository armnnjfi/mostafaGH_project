<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
</head>

<body>
    <table cellpadding="10">
        <thead>
            <tr>
                <th>request id</th>
                <th>user id</th>
                <th>start Date</th>
                <th>end Date</th>
                <th>Reasons</th>
                <th>approve</th>
                <th>reject</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['leave_requests'] as $request) { ?>
                <tr>
                    <td><?php echo $request['id']; ?></td>
                    <td><?php echo $request['user_id']; ?></td>
                    <td><?php echo $request['start_date']; ?></td>
                    <td><?php echo $request['end_date']; ?></td>
                    <td><?php echo $request['reason']; ?></td>
                    <td>
                        <form action="<?= Constants::BASE_URL ?>approve_reject_request" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">
                            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                            <input type="submit" name="submit" value="approve">
                        </form>
                        
                    </td>
                    
                    <td>
                        <form action="<?= Constants::BASE_URL ?>approve_reject_request" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token'] ?>">
                            <input type="hidden" name="request_id" value="<?php echo $request['id'] ?>">
                            <input type="submit" name="submit" value="reject">
                        </form>
                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
