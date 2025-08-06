<?php
require '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/style.css">
  <title>Company</title>
</head>

<body>

  <div class="top-bar">
    <a href="../main/division.php">DIVISION</a>
    <a href="../main/department.php">DEPARTMENT</a>
    <a href="../main/employee.php">EMPLOYEE</a>
    <a href="../main/position.php">POSITION</a>
    <a href="../main/project.php">PROJECT</a>
  </div>

  <div class="content">
    <h2>Division</h2>

    <div class="add_info">
      <div class="content">
        <h3>เพิ่มข้อมูล</h3>
        <form class="addinfo_form">
          <label for="divname">Division name:</label>
          <input type="text" id="divname" name="divname" required><br>
          <label for="hdivname" id="hname_label">Head name:</label>
          <input type="text" id="hdivname" name="hdivname" required>
        </form>
        <a href="#"><button class="btn" id="confirm" type="submit">ยืนยัน</button></a>
        <a href="../main/division.php"><button class="btn" id="cancel">ยกเลิก</button></a>
      </div>


    </div>
</body>