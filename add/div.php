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

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") : ?>
          <?php
          $divname = mysqli_real_escape_string($connect, $_POST["divname"]);
          $hdivname = mysqli_real_escape_string($connect, $_POST["hdivname"]);
          $sql = "INSERT INTO division (NAME,HEAD) VALUE ('$divname','$hdivname')";
          $result = mysqli_query($connect, $sql);
          ?>
          <?php if ($result) : ?>
            <div class="boxform">
              <h4>บันทึกเรียบร้อย</h4>
              <a href="../main/division.php"><button class="btn" id="cancel">Go Back</button></a>
            </div>
          <?php else : ?>
            <h4>บันทึกผิดพลาด</h4>
            <a href="pj.php">เพิ่มใหม่</a>
          <?php endif; ?>
        <?php else : ?>
          <div class="boxform">
            <form class="addinfo_form" method="post" action="">
              <label for="divname">Division name:</label>
              <input type="text" id="divname" name="divname" required><br>
              <label for="hdivname" id="hname_label">Head name:</label>
              <input type="text" id="hdivname" name="hdivname" required><br>
              <button class="btn" id="confirm" type="submit">ยืนยัน</button>
            </form>

            <a href="../main/division.php"><button class="btn" id="cancel">ยกเลิก</button></a>
          </div>
        <?php endif; ?>

      </div>

    </div>

  </div>
</body>
