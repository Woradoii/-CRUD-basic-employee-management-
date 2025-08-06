<?php

require '../config/config.php';
echo ($_GET['emp_id']);
$ID = mysqli_real_escape_string($connect, $_GET["emp_id"]);
$sql = "DELETE FROM employee WHERE ID = " . $ID;



$result = mysqli_query($connect, $sql);

header("Location: ../main/employee.php");

?>

