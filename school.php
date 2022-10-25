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
<h1 style="text-align:center;">Schools</h1>

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
      $sqlAdd = "INSERT INTO School (SchoolName, State, City) value (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $_POST['sName'], $_POST['sState'], $_POST['sCity']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New school added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "UPDATE School SET SchoolName=?, State=?, City=? WHERE SchoolID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssi", $_POST['sName'], $_POST['sState'], $_POST['sCity'], $_POST['scid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">School edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "DELETE FROM School where SchoolID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['scid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">School deleted.</div>';
      break;
  }
}
?>
<?php
$sql = "SELECT * from School";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

    <table class="table table-danger">
  <thead>
    <tr>
      <th>School ID</th>
      <th>School Name</th>
      <th>State</th>
      <th>City</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td><?=$row["SchoolID"]?></td>
    <td><a href="student-school.php?id=<?=$row["SchoolID"]?>"><?=$row["SchoolName"]?></a></td>
    <td><?=$row["State"]?></td>
    <td><?=$row["City"]?></td>
        <td>
    <form method="post" action="school-edit.php">
        <input type="hidden" name="scid" value="<?=$row["SchoolID"]?>" />
        <input type="submit" value="Edit" class="btn btn-danger" />
    </form>

    </td>
       <td>
    <form method="post" action="school-delete-save.php">
        <input type="hidden" name="scid" value="<?=$row["SchoolID"]?>" />
        <input type="submit" value="Delete" class="btn btn-primary" onclick="return confirm('Are you sure?')" />
    </form>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>

     <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchool">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSchoolLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addSchoolLabel">Add School</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="schoolName" class="form-label">School Name</label>
                  <input type="text" class="form-control" id="schoolName" aria-describedby="nameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the school's name.</div>
                </div>
                <div class="mb-3">
                  <label for="state" class="form-label">State</label>
                  <input type="text" class="form-control" id="state" aria-describedby="stateHelp" name="sState">
                  <div id="stateHelp" class="form-text">Enter the school's state.</div>
                </div>
                <div class="mb-3">
                  <label for="city" class="form-label">City</label>
                  <input type="text" class="form-control" id="city" aria-describedby="cityHelp" name="sCity">
                  <div id="cityHelp" class="form-text">Enter the school's city.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>