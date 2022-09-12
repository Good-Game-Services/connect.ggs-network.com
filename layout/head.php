<?php error_reporting(0);

$parts = explode('/', __FILE__);
$filename = $parts[count($parts) - 1];

if (strpos($_SERVER["SCRIPT_URI"], $filename) !== false) {
	exit("illegal method");
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="GGS Network">
    <link rel="icon" type="image/ico" href="https://ggs-network.com/assets/favicon.ico" />
    <!-- <script data-host="https://insights.jusoft.dev/public/index.php" data-dnt="false" src="https://insights.jusoft.dev/js/script.js" id="ZwSg9rf6GA" async defer></script> -->
</head>