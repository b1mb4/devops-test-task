<?php

$hostname = gethostname();

$time = date('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Site 3</title>
</head>
<body style="font-family: sans-serif; background: #FFB6C1;">
    <h1>Dynamic Site 3</h1>
    <p>Served by PHP container as Site 3</p>
    <p>Hostname: <?php echo $hostname; ?></p>
    <p>Time: <?php echo $time; ?></p>
</body>
</html>