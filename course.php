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
   <h1 style="text-align:center;">Courses</h1>

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
      $sqlAdd = "INSERT INTO Course (CourseID, CourseName) value (?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("is", $_POST['cID'], $_POST['cName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New course added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "UPDATE Course SET CourseID=?, CourseName=? WHERE Course_ID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("isi", $_POST['cID'], $_POST['cName'], $_POST['cid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Course edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "DELETE FROM Course WHERE Course_ID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Course deleted.</div>';
      break;
  }
}
?>
<?php
$sql = "SELECT * from Course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

    <table class="table table-success">
  <thead>
    <tr>
      <th>Course ID</th>
      <th>Course Name</th>
      <th>Professor ID</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td><?=$row["CourseID"]?></td>
    <td><?=$row["CourseName"]?></td>
    <td><?=$row["ProfessorID"]?></td>
    <td>
       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editCourse<?=$row["Course_ID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCourse<?=$row["Course_ID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourse<?=$row["CourseID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCourse<?=$row["Course_ID"]?>Label">Edit Course</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCourse<?=$row["Course_ID"]?>Name" class="form-label">Course ID</label>
                          <input type="text" class="form-control" id="editCourse<?=$row["Course_ID"]?>Name" aria-describedby="editCourse<?=$row["Course_ID"]?>Help" name="cID" value="<?=$row['CourseID']?>">
                          <div id="editCourse<?=$row["Course_ID"]?>Help" class="form-text">Enter the course ID.</div>
                        </div>
                         <div class="mb-3">
                          <label for="editCourse<?=$row["Course_ID"]?>Name" class="form-label">Course Name</label>
                          <input type="text" class="form-control" id="editCourse<?=$row["Course_ID"]?>Name" aria-describedby="editCourse<?=$row["Course_ID"]?>Help" name="cName" value="<?=$row['CourseName']?>">
                          <div id="editCourse<?=$row["Course_ID"]?>Help" class="form-text">Enter the course name.</div>
                        </div>
                        <input type="hidden" name="cid" value="<?=$row['Course_ID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
    </td>
       <td>
    <form method="post" action="course-delete-save.php">
        <input type="hidden" name="cid" value="<?=$row["Course_ID"]?>" />
        <input type="submit" value="Delete" class="btn btn-primary" onclick="return confirm('Are you sure?')" />
    </form>
    </tr>

  </tbody>
    </table>
    <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">
        Add New
      </button>
      <!-- Modal -->
      <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCourseLabel">Add Course</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="courseID" class="form-label">Course ID</label>
                  <input type="text" class="form-control" id="courseID" aria-describedby="couseIDHelp" name="cID">
                  <div id="courseIDHelp" class="form-text">Enter the course ID.</div>
                </div>
                <div class="mb-3">
                  <label for="courseName" class="form-label">Course Name</label>
                  <input type="text" class="form-control" id="courseName" aria-describedby="courseNameHelp" name="cName">
                  <div id="courseNameHelp" class="form-text">Enter the course name.</div>
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