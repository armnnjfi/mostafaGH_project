<?php
session_start();

include "app/services/SecurityService.php";
include "core/route.php";
include "core/controller.php";


$csrf_token = new SecurityService();
$csrf_token->setCSRFToken();

new route();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nasrollahi Code</title>
</head>
<body>
    
</body>
</html>