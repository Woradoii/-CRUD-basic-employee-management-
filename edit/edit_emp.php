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

    <?php
    $ID = mysqli_real_escape_string($connect, $_GET["emp_id"]);
    $sql = "SELECT *
                    FROM employee as e 
                    WHERE ID =" . $ID;


    $result = mysqli_query($connect, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    var_dump($rows);
    $emp = $rows[0];
    var_dump($rows);
    ?>

    <div class="content">
        <h2>Employee</h2>
        <div class="add_info">
            <div class="content">
                <h3>แก้ไขข้อมูล</h3>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                    <?php
                    $empname = mysqli_real_escape_string($connect, $_POST["empname"]);
                    $type = mysqli_real_escape_string($connect, $_POST["type"]);
                    // แก้
                    $position = $_POST["position"] != "" ? mysqli_real_escape_string($connect, $_POST["position"]) : 'null';
                    $division = $_POST["division"] != "" ? mysqli_real_escape_string($connect, $_POST["division"]) : 'null';
                    $department = $_POST["department"] != "" ? mysqli_real_escape_string($connect, $_POST["department"]) : 'null';
                    $sql = "UPDATE employee
                    -- แก้
                    SET NAME = '$empname', TYPE = '$type', POSITION_ID = $position, DIV_ID = $division, DEP_ID = $department
                    WHERE ID =" . $ID;

                    $result = mysqli_query($connect, $sql);
                    ?>
                    <?php if ($result) : ?>
                        <div class="boxform">
                            <h4>บันทึกเรียบร้อย</h4>
                            <a href="../main/employee.php"><button class="btn" id="cancel">Go Back</button></a>
                        </div>
                    <?php else : ?>
                        <h4>บันทึกผิดพลาด</h4>
                        <a href="emp.php">เพิ่มใหม่</a>
                    <?php endif; ?>

                <?php else : ?>
                    <div class="boxform">
                        <form class="addinfo_form" method="post" action="">
                            <label for="empname">Name:</label>
                            <input type="text" id="empname" name="empname" required value="<?php echo ($emp["NAME"]) ?>">

                            <div class="type">
                                <p>Type:</p>
                                <input type="radio" id="fix" name="type" value="FIX" required <?php echo ($emp["TYPE"]) == 'FIX' ? 'checked' : '' ?>>
                                <label for="fix">FIX</label><br>
                                <input type="radio" id="rovers" name="type" value="ROVERS" required <?php echo ($emp["TYPE"]) == 'ROVERS' ? 'checked' : '' ?>>
                                <label for="rovers">ROVERS</label><br>
                            </div>

                            <div class="dropdown">
                                <div class="position">
                                    <p>Position:</p>

                                    <?php
                                    $sql = "SELECT ID, NAME FROM position";
                                    $result = mysqli_query($connect, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<select name="position" >';
                                        echo '<option value="">ไม่มี</option>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ID'] . '" ' .  ($emp["POSITION_ID"] == $row['ID']  ? 'selected' : '') . ' >' . $row['NAME'] . '</option>';
                                        }
                                        echo '</select>';
                                    } else {
                                        echo 'No data available';
                                    }

                                    ?>

                                </div>

                                <div class="division">
                                    <p>Division:</p>
                                    <?php
                                    $sql = "SELECT ID, NAME FROM division";
                                    $result = mysqli_query($connect, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<select name="division">';
                                        echo '<option value="">ไม่มี</option>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ID'] . '" ' .  ($emp["DIV_ID"] == $row['ID']  ? 'selected' : '') . ' >' . $row['NAME'] . '</option>';
                                        }
                                    } else {
                                        echo 'No data available';
                                    }
                                    echo '</select>';
                                    ?>

                                </div>

                                <div class="department" id="div1">
                                    <p>Department:</p>
                                    <?php
                                    $sql = "SELECT ID, NAME FROM department";
                                    $result = mysqli_query($connect, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<select name="department" id="ddldepartment">';
                                        echo '<option value="">ไม่มี</option>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ID'] . '" ' .  ($emp["DEP_ID"] == $row['ID']  ? 'selected' : '') . ' >' . $row['NAME'] . '</option>';
                                        }
                                    } else {
                                        echo 'No data available';
                                    }
                                    echo '</select>';
                                    ?>
                                </div>
                            </div>
                            <button class="btn" id="confirm" type="submit">ยืนยัน</button>
                        </form>

                        <a href="../main/employee.php"><button class="btn" id="cancel">ยกเลิก</button></a>
                        <!-- <button onclick="hideElement()" type="button">Hide Element</button>
                        <button onclick="showElement()" type="button">Show Element</button> -->
                    </div>
                <?php endif; ?>


            </div>



        </div>
</body>

<!-- <script>
    function hideElement() {
        // Get a reference to the element
        var element = document.getElementById("div1");
        // Set its display property to "none" to hide it
        element.style.display = "none";
    }

    function showElement() {
        // Get a reference to the element
        var element = document.getElementById("div1");
        // Set its display property to "none" to hide it
        element.style.display = "block";
    }
</script> -->