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
<h1 style="text-align:center;">Add Course</h1>

<form method="post" action="course-add-save.php">

  <div class="mb-3">
    <label for="courseID">Course ID</label>
    <input type="text" class="form-control" id="courseID" aria-describedby="courseIDHelp" name="cID">
    <div id="courseIDHelp" class="form-text text-muted">Enter the course ID.</div>
  </div>

<div class="mb-3">
    <label for="courseName">Course Name</label>
    <input type="text" class="form-control" id="courseName" aria-describedby="cnameHelp" name="cName">
    <div id="cnameHelp" class="form-text text-muted">Enter the course name.</div>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>