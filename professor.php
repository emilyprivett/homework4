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
<h1 style="text-align:center;">Professors</h1>

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
      $sqlAdd = "INSERT INTO Professor (ProfessorFirstName, ProfessorLastName, Email) value (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $_POST['pFName'], $_POST['pLName'], $_POST['email']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New professor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "UPDATE Professor SET ProfessorFirstName=?, ProfessorLastName=? WHERE ProfessorID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sss", $_POST['pFName'], $_POST['pLName'], $_POST['email']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Professor edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "DELETE FROM Professor WHERE ProfessorID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['pid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Professor deleted.</div>';
      break;
  }
}
?>
<?php
$sql = "SELECT * from Professor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>

    <table class="table table-info">
  <thead>
    <tr>
      <th>Professor ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Course Info</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td><?=$row["ProfessorID"]?></td>
    <td><?=$row["ProfessorFirstName"]?></td>
    <td><?=$row["ProfessorLastName"]?></td>
    <td><?=$row["Email"]?></td>
    <td>
      <form method="post" action="professorcourse.php">
        <input type="hidden" name="id" value="<?=$row["ProfessorID"]?>" />
        <input type="submit" value="Courses" />
      </form>
    </td>
    <td>
  <td>
       <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProfessor<?=$row["ProfessorID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editProfessor<?=$row["ProfessorID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfessor<?=$row["ProfessorID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editProfessor<?=$row["ProfessorID"]?>Label">Edit Professor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editProfessor<?=$row["ProfessorID"]?>Name" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="editProfessor<?=$row["ProfessorID"]?>Name" aria-describedby="editProfessor<?=$row["ProfessorID"]?>Help" name="pFName" value="<?=$row['ProfessorFirstName']?>">
                          <div id="editCustomer<?=$row["Customer_ID"]?>Help" class="form-text">Enter the professor's first name.</div>
                        </div>
                         <div class="mb-3">
                          <label for="editProfessor<?=$row["ProfessorID"]?>Name" class="form-label">Last Name</label>
                          <input type="text" class="form-control" id="editProfessor<?=$row["ProfessorID"]?>Name" aria-describedby="editProfessor<?=$row["ProfessorID"]?>Help" name="pLName" value="<?=$row['ProfessorLastName']?>">
                          <div id="editProfessor<?=$row["ProfessorID"]?>Help" class="form-text">Enter the professor's last name.</div>
                        </div>
                        <input type="hidden" name="pid" value="<?=$row['ProfessorID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>

    </td>
       <td>
    <form method="post" action="professor-delete-save.php">
        <input type="hidden" name="pid" value="<?=$row["ProfessorID"]?>" />
        <input type="submit" value="Delete" class="btn btn-primary" onclick="return confirm('Are you sure?')" />
    </form>

    </td>
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProfessor">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProfessorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addProfessorLabel">Add Professor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="professorFirstName" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="professorFirstName" aria-describedby="nameHelp" name="pFName">
                  <div id="nameHelp" class="form-text">Enter the professor's first name.</div>
                </div>
                <div class="mb-3">
                  <label for="professorLastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="professorLastName" aria-describedby="nameHelp" name="pLName">
                  <div id="pLName" class="form-text">Enter the professor's last name.</div>
                </div>
                <div class="mb-3">
                  <label for="professorEmail" class="form-label">Email</label>
                  <input type="text" class="form-control" id="professorEmail" aria-describedby="emailHelp" name="email">
                  <div id="emailHelp" class="form-text">Enter the professor's email.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <br />
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>