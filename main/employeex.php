<?php
session_start();

require '../layouts/header.php';
require '../layouts/menu.php';

require '../config/config.php';

if (empty($_SESSION['username'])) {
  echo 'have no permission';
} else {
?>

  <!-- header -->

  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-lg-6 main-header">
            <h2>Employee</h2>
          </div>
          <div class="col-lg-6 breadcrumb-right">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
              <li class="breadcrumb-item">Pages</li>
              <li class="breadcrumb-item active">Sample page</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Container-fluid starts-->

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">

            <!-- body -->

            <div class="card-body">

              <!-- system -->

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

              <!-- search tab -->

              <form>
                <div class="row">
                  <div class="col-sm-6 offset-sm-3">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">ใส่ข้อมูลเพื่อค้นหา</label>
                      <input class="form-control" type="text" id="insert" name="search" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-pill btn-primary" type="submit" id="submit"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
                  </div>
                </div>
              </form>

              <div class="row mt-5">
                <div class="col-sm-12 text-right">
                  <a href="../add/empform.php"><button class="btn btn-success btn-sm mb-5" id="add"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูล</button></a>
                </div>
              </div>

              <!-- table -->

              <div class="row">
                <div class="col-sm-12">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="table-primary">

                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Position</th>
                          <th>Division</th>
                          <th>Department</th>
                          <th> </th>
                        </tr>
                      </thead>

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
                              <a href="../edit/edit_emp.php?emp_id=<?php echo $row['ID'] ?>"><button class="btn btn-info btn-sm" id="update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                              <a href="../delete/delete_emp.php?emp_id=<?php echo $row['ID'] ?>"><button class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button></a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Container-fluid Ends-->

  </div>

<?php
}
?>

<?php
require '../layouts/footer.php';
?>