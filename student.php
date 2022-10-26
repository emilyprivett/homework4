<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homework 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Homework 4</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="professor.php">Professors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="course.php">Courses</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student.php">Students</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="school.php">Schools</a>
      </li>
                  <li class="nav-item">
        <a class="nav-link" href="studentschool.php">Student & School</a>
      </li>
    </ul>
  </div>
</nav>
    <h1 style="text-align:center;">Students</h1>

<?php
$servername = "localhost";
$username = "emilypri_homework3";
$password = "h0mework_3";
$dbname = "emilypri_firstdatabase";
 
// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "INSERT INTO Student (StudentFirstName, StudentLastName) value (?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("ss", $_POST['sFName'], $_POST['sLName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New student added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "UPDATE Student SET StudentFirstName=?, StudentLastName=? WHERE StudentID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ss", $_POST['sFName'], $_POST['sLName']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Student edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "DELETE FROM Student WHERE StudentID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['sid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Student deleted.</div>';
      break;
  }
}
?>
<?php
$sql = "SELECT * from Student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

    <table class="table table-warning">
  <thead>
    <tr>
      <th>Student ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>School ID</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td><?=$row["StudentID"]?></td>
    <td><?=$row["StudentFirstName"]?></td>
    <td><?=$row["StudentLastName"]?></td>
    <td><?=$row["SchoolID"]?></td>
    <td>
       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editStudent<?=$row["StudentID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editStudent<?=$row["StudentID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStudent<?=$row["StudentID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editStudent<?=$row["StudentID"]?>Label">Edit Student</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editStudent<?=$row["StudentID"]?>Name" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["StudentID"]?>Name" aria-describedby="editStudent<?=$row["StudentID"]?>Help" name="sFName" value="<?=$row['StudentFirstName']?>">
                          <div id="editStudent<?=$row["StudentID"]?>Help" class="form-text">Enter the student's first name.</div>
                        </div>
                         <div class="mb-3">
                          <label for="editStudent<?=$row["StudentID"]?>Name" class="form-label">Last Name</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["StudentID"]?>Name" aria-describedby="editStudent<?=$row["StudentID"]?>Help" name="sLName" value="<?=$row['StudentLastName']?>">
                          <div id="editStudent<?=$row["StudentID"]?>Help" class="form-text">Enter the student's last name.</div>
                        </div>
                         <div class="mb-3">
                     <label for="editStudent<?=$row["StudentID"]?>" class="form-label">School ID</label>
                          <select class="form-select" aria-label="Select School ID" id="schoolIDList" name="sil">
                            <?php
                                $SchoolSql = "SELECT * FROM School ORDER BY SchoolID";
                                $SchoolResult = $conn->query($SchoolSql);
                                while($SchoolRow = $SchoolResult->fetch_assoc()) {
                                  if($SchoolRow['SchoolID'] == $row['SchoolID']){
                                    $selText = "selected";
                                  } else {
                                    $selText ="";
                                  }
                            ?>
                              <option value="<?=$SchoolRow['SchoolID']?>"<?=$selText?>><?=$SelectRow['SchoolID']?></option>
                            <?php
                                  }
                            ?>
                          </select>
                </div>
                        <input type="hidden" name="sid" value="<?=$row['StudentID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
    </td>
       <td>
    <form method="post" action="student-delete-save.php">
        <input type="hidden" name="sid" value="<?=$row["StudentID"]?>" />
        <input type="submit" value="Delete" class="btn btn-primary" onclick="return confirm('Are you sure?')" />
    </form>

    </td>
  </tr>

  </tbody>
    </table>
     <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStudentLabel">Add Student</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="studentFirstName" class="form-label">Student First Name</label>
                  <input type="text" class="form-control" id="studentFirstName" aria-describedby="nameHelp" name="sFName">
                  <div id="nameHelp" class="form-text">Enter the student's first name.</div>
                </div>
                <div class="mb-3">
                  <label for="studentLastName" class="form-label">Student Last Name</label>
                  <input type="text" class="form-control" id="state" aria-describedby="nameHelp" name="sLName">
                  <div id="nameHelp" class="form-text">Enter the student's last name.</div>
                </div>
                <div class="mb-3">
                     <label for="addSchool<?=$row["SchoolID"]?>Name" class="form-label">School ID</label>
                          <select class="form-select" aria-label="Select School ID" id="SchoolIDList" name="sil">
                            <?php
                                $SchoolSql = "SELECT * FROM School ORDER BY SchoolID";
                                $SchoolResult = $conn->query($SchoolSql);
                                while($SchoolRow = $SchoolResult->fetch_assoc()) {
                                  if($SchoolRow['SchoolID'] == $row['SchoolID']){
                                    $selText = "selected";
                                  } else {
                                    $selText ="";
                                  }
                            ?>
                              <option value="<?=$SchoolRow['SchoolID']?>"<?=$selText?>><?=$SchoolRow['SchoolID']?></option>
                            <?php
                                  }
                            ?>
                          </select>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   
   <?php
                  }
                } else {
                  echo "0 results";
                }
                $conn->close();
                ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>