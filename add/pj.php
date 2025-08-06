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
    <h2>Project</h2>

    <div class="add_info">
      <div class="content">
        <h3>เพิ่มข้อมูล</h3>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
          <?php
          $pjname = mysqli_real_escape_string($connect, $_POST["pjname"]);
          $sql = "INSERT INTO project (NAME) VALUE ('$pjname')";
          $result = mysqli_query($connect, $sql);
          ?>
          <?php if ($result) : ?>
            <div class="boxform">
              <h4>บันทึกเรียบร้อย</h4>
              <a href="../main/project.php"><button class="btn" id="cancel">Go Back</button></a>
            </div>
          <?php else : ?>
            <h4>บันทึกผิดพลาด</h4>
            <a href="pj.php">เพิ่มใหม่</a>
          <?php endif; ?>

        <?php else : ?>
          <div class="boxform">
            <form class="addinfo_form" method="post">
              <label for="pjname">Project name:</label>
              <input type="text" id="pjname" name="pjname" required>
              <button class="btn" id="confirm" type="submit">ยืนยัน</button>
            </form>

            <a href="../main/project.php"><button class="btn" id="cancel">ยกเลิก</button></a>
          </div>
        <?php endif; ?>
      </div>

    </div>

</body>