<?php
include('vendor/autoload.php');

print_r(fmanager\models\connections::getAll());
exit;

print_r($customer->retrieve());
exit;

$connection = new \fmanager\libraries\database\connection("mysql:host=127.0.0.1;port=3306;dbname=fmanager", "root", "");

print_r($connection->select('customers'));
exit;

$ftp = new \fmanager\libraries\ftp\ftp('xxxxxxx');

$ftp->ftp_login('xxxxxx', 'xxxx');

// after ftp_login(...)
$ftp->ftp_pasv(true);

echo '<pre>';
var_dump($ftp->ftp_nlist('.'));

exit;
?>

<!--<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/app.css" />
</head>
<script type="text/javascript" src="js/script.js"></script>
<body>
<!-- what to show depends on the code -->
<?php include('templates/home.tpl'); ?>
</body>
</html>-->