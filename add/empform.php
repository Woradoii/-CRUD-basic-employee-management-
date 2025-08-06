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

              <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                <?php

                $empname = mysqli_real_escape_string($connect, $_POST["empname"]);
                $type = mysqli_real_escape_string($connect, $_POST["type"]);
                // แก้
                $position = $_POST["position"] != "" ? mysqli_real_escape_string($connect, $_POST["position"]) : 'null';
                $division =  $_POST["division"] != "" ? mysqli_real_escape_string($connect, $_POST["division"]) : 'null';
                $department = $_POST["department"] != "" ? mysqli_real_escape_string($connect, $_POST["department"]) : 'null';
                $sql = "INSERT INTO employee (NAME,TYPE,POSITION_ID,DIV_ID,DEP_ID) VALUE ('$empname','$type',$position,$division,$department) ";

                $result = mysqli_query($connect, $sql);
                ?>

                <?php if ($result) : ?>
                  <div class="boxform">
                    <h4>บันทึกเรียบร้อย</h4>
                    <a href="../main/employeex.php"><button class="btn" id="cancel">Go Back</button></a>
                  </div>
                <?php else : ?>
                  <h4>บันทึกผิดพลาด</h4>
                  <a href="dep.php">เพิ่มใหม่</a>
                <?php endif; ?>

              <?php else : ?>

                <!-- Form -->

                <form class="form theme-form">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label text-right">Name</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="text" name="empname" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label text-right">Type</label>
                          <div class="col-sm-9">
                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                              <div class="radio radio-primary">
                                <input id="radioinline1" type="radio" name="type" value="FIX" required>
                                <label class="mb-0" for="radioinline1">FIX</label>
                              </div>
                              <div class="radio radio-primary">
                                <input id="radioinline2" type="radio" name="type" value="ROVERS" required>
                                <label class="mb-0" for="radioinline2">ROVERS</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label text-right">Division</label>
                          <div class="col-sm-9">
                            <?php
                            $sql = "SELECT ID, NAME FROM division";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                              echo '<select name="division" id="division" class="form-control digits" >';
                              echo '<option value="">ไม่มี</option>';
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID'] . '">' . $row['NAME'] . '</option>';
                              }
                            } else {
                              echo 'No data available';
                            }
                            echo '</select>';
                            ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label text-right">Department</label>
                          <div class="col-sm-9">
                            <?php
                            $sql = "SELECT ID, NAME FROM department";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                              echo '<select name="department" id="department" class="form-control digits" >';
                              echo '<option value="">ไม่มี</option>';
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID'] . '">' . $row['NAME'] . '</option>';
                              }
                            } else {
                              echo 'No data available';
                            }
                            echo '</select>';
                            ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label text-right">Position</label>
                          <div class="col-sm-9">
                            <?php
                            $sql = "SELECT ID, NAME FROM position";
                            $result = mysqli_query($connect, $sql);
                            if (mysqli_num_rows($result) > 0) {
                              echo '<select name="position" id="position" class="form-control digits" >';
                              echo '<option value="">ไม่มี</option>';
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID'] . '">' . $row['NAME'] . '</option>';
                              }
                            } else {
                              echo 'No data available';
                            }
                            echo '</select>';
                            ?>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <div class="col-sm-9 offset-sm-3">
                      <button class="btn btn-pill btn-primary" type="submit">Submit</button>
                      <input class="btn btn-pill btn-light" type="reset" value="Cancel">
                    </div>
                  </div>
                </form>

                <!-- End -->


              <?php endif; ?>

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