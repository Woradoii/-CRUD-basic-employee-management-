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
    <a href="division.php">DIVISION</a>
    <a href="department.php">DEPARTMENT</a>
    <a href="employee.php">EMPLOYEE</a>
    <a href="position.php">POSITION</a>
    <a href="project.php">PROJECT</a>
  </div>

  <div class="content">
    <h2>Department</h2>

    <div class="searchtab">

      <?php
      $sql = "SELECT d.ID AS 'DEPARTMENT ID', d.NAME AS 'DEPARTMENT NAME', e.NAME AS 'HEAD NAME' FROM department d LEFT JOIN employee e ON d.HEAD = e.ID";
      if (isset($_GET["search"])) {
        $search = mysqli_real_escape_string($connect, $_GET["search"]);
        $sql .= " WHERE d.NAME LIKE '%$search%' OR e.NAME LIKE '%$search%'";

      }
      $sql .= " ORDER BY d.ID ASC";
      $result = mysqli_query($connect, $sql);
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>

      <form class="search">
        <p>ใส่ข้อมูลเพื่อค้นหา</p>
        <input type="search" name="search" id="insert" required>
        <button class="btn" id="submit" type="submit">ค้นหา</button>
      </form>

      <a href="../add/dep.php"><button class="btn" id="add">เพิ่มข้อมูล</button></a>

    </div>

    <table>

      <tr id="header">
        <th>ID</th>
        <th>Name</th>
        <th>Head</th>
        <th></th>
      </tr>

      
      <?php foreach($rows as $row) : ?>

        <tr>
          <td><?php echo $row['DEPARTMENT ID'] ?></td>
          <td><?php echo $row['DEPARTMENT NAME'] ?></td>
          <td><?php echo $row['HEAD NAME'] ?></td>

          <th>
            <div class="command">
              <a href="#"><button class="btn" id="update">Update</button></a>
              <a href="#"><button class="btn" id="delete">Delete</button></a>
            </div>
          </th>

        </tr>

      <?php endforeach; ?>

    </table>

  </div>

</body>