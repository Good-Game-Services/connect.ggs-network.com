<?php
require("func.php");
require("value.php");
$db = mysqli_connect("HOSTNAME","USERNAME","PASSWORD") or die("can't connect this database");
mysqli_select_db($db, "DATABASE");
mysqli_set_charset($db, 'utf8');
