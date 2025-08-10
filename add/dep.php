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
    <h2>Department</h2>

    <div class="add_info">
      <div class="content">
        <h3>เพิ่มข้อมูล</h3>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
          <?php
          $depname = mysqli_real_escape_string($connect, $_POST["depname"]);
          $headname = mysqli_real_escape_string($connect, $_POST["headname"]);
          $sql1 = "INSERT INTO department (NAME) VALUE ('$depname') ";
          $sql2 = "INSERT INTO employee (NAME) VALUE ('$headname')";
          $result1 = mysqli_query($connect, $sql1);
          $result2 = mysqli_query($connect, $sql2);
          ?>
          <?php if ($result1 && $result2) : ?>
            <div class="boxform">
              <h4>บันทึกเรียบร้อย</h4>
              <a href="../main/department.php"><button class="btn" id="cancel">Go Back</button></a>
            </div>
          <?php else : ?>
            <h4>บันทึกผิดพลาด</h4>
            <a href="dep.php">เพิ่มใหม่</a>
          <?php endif; ?>

        <?php else : ?>
          <div class="boxform">
            <form class="addinfo_form" method="post">
              <label for="depname">Department name:</label>
              <input type="text" id="depname" name="depname" required><br>
              <div class="division">
                <p>Division:</p>
                <?php
                $sql = "SELECT ID, NAME FROM division";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                  echo '<select name="division">';
                  echo '<option value="">ไม่มี</option>';
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['ID'] . '">' . $row['NAME'] . '</option>';
                  }
                } else {
                  echo 'No data available';
                }
                echo '</select>';
                ?><br>

                <label for="hdivname" id="headname_label">Head name:</label>
                <input type="text" id="headname" name="headname" required><br>

                <br><button class="btn" id="confirm" type="submit">ยืนยัน</button>


              </div>
            </form>
            <a href="../main/department.php"><button class="btn" id="cancel">ยกเลิก</button></a>
          </div>
        <?php endif; ?>


      </div>

    </div>
</body>
