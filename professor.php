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
    <form method="post" action="professor-edit.php">
        <input type="hidden" name="pid" value="<?=$row["ProfessorID"]?>" />
        <input type="submit" value="Edit" class="btn btn-danger" />
    </form>

    </td>
       <td>
    <form method="post" action="professor-delete-save.php">
        <input type="hidden" name="pid" value="<?=$row["ProfessorID"]?>" />
        <input type="submit" value="Delete" class="btn btn-primary" />
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
    <a href="professor-add.php" class="btn btn-primary">Add New</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>