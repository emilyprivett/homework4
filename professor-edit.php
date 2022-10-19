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
<h1 style="text-align:center;">Edit Professor</h1>

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
$sql = "SELECT ProfessorID, ProfessorFirstName, ProfessorLastName FROM Professor WHERE ProfessorID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['pid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <form method="post" action="professor-edit-save.php">
  <div class="mb-3">
    <label for="professorFirstName">Name</label>
    <input type="text" class="form-control" id="professorFirstName" aria-describedby="nameHelp" name="pFName" value="<?=$row['ProfessorFirstName']?>">
    <div id="nameHelp" class="form-text text-muted">Enter the professor's name.</div>
  </div>
  <div class="mb-3">
    <label for="professorLastName">Name</label>
    <input type="text" class="form-control" id="professorLastName" aria-describedby="nameHelp" name="pLName" value="<?=$row['ProfessorLastName']?>">
    <div id="nameHelp" class="form-text text-muted">Enter the professor's name.</div>
  </div>
   <div class="mb-3">
    <label for="professorEmail">Email</label>
    <input type="text" class="form-control" id="professorEmail" aria-describedby="emailHelp" name="email" value="<?=$row['Email']?>">
    <div id="emailHelp" class="form-text text-muted">Enter the professor's email.</div>
  </div>
  <input type="hidden" name="pid" value="<?=$row['ProfessorID']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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