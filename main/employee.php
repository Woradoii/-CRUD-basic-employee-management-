<?php

require '../config/config.php';
// session_start();
// if (empty($_SESSION['username'])) {
//   echo 'have no permission';
  
// } else {
//   echo 'Hello ' . $_SESSION['username'];
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
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
      <h2>Employee</h2>
      <div class="searchtab">

        <?php
        $sql = "SELECT e.ID AS 'ID',
                    e.NAME AS 'NAME',
                    e.TYPE AS 'TYPE', 
                    p.NAME AS 'POSITION NAME', 
                    division.NAME AS 'DIVISION NAME', 
                    department.NAME AS 'DEPARTMENT NAME' 
                    FROM employee as e 
                    LEFT JOIN position as p ON e.POSITION_ID = p.ID 
                    LEFT JOIN division ON e.DIV_ID = division.ID 
                    LEFT JOIN department ON e.DEP_ID = department.ID";

        if (isset($_GET["search"])) {
          $search = mysqli_real_escape_string($connect, $_GET["search"]);
          $sql .= " WHERE e.NAME LIKE '%$search%' OR e.TYPE LIKE '%$search%' OR p.NAME LIKE '%$search%' OR division.NAME LIKE '%$search%' OR department.NAME LIKE '%$search%'";
        }
        $sql .= " ORDER BY ID ASC ";
        $result = mysqli_query($connect, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>

        <form class="search">
          <p>ใส่ข้อมูลเพื่อค้นหา</p>
          <input type="text" id="insert" name="search" required>
          <button class="btn" id="submit" type="submit">ค้นหา</button>
        </form>

        <a href="../add/emp.php"><button class="btn" id="add">เพิ่มข้อมูล</button></a>
      </div>

      <table>
        <tr id="header">
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Position</th>
          <th>Division</th>
          <th>Department</th>
          <th> </th>
        </tr>

        <?php foreach ($rows as $row) : ?>
          <tr>
            <td><?php echo $row['ID'] ?></td>
            <td><?php echo $row['NAME'] ?></td>
            <td><?php echo $row['TYPE'] ?></td>
            <td><?php echo $row['POSITION NAME'] ?></td>
            <td><?php echo $row['DIVISION NAME'] ?></td>
            <td><?php echo $row['DEPARTMENT NAME'] ?></td>
            <td>
              <div class="command">
                <a href="../edit/edit_emp.php?emp_id=<?php echo $row['ID'] ?>"><button class="btn-update" id="update">Update</button></a>
                <a href="../delete/delete_emp.php?emp_id=<?php echo $row['ID'] ?>"><button class="btn-delete" id="delete">Delete</button></a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>

<?php
// }
?>