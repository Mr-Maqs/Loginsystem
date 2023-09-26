<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {

  header("location: login.php");
  exit;
}
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "nextg1";

$conn = mysqli_connect($servername, $username, $password, $database);

if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $sql = "delete from `notes_crud` where `Sno`='$sno'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $delete = true;
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['snoedit'])) {
    $sno = $_POST['snoedit'];
    $title = $_POST["titleedit"];
    $description = $_POST["descriptionedit"];
    $sql = "UPDATE `notes_crud` SET `title` = '$title' , `description` = '$description' WHERE `notes_crud`.`Sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    }
  } else {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $sql = "INSERT INTO `notes_crud` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $insert = true;
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YOURtime | Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    *{
      box-sizing: border-box;
    }
  </style>

</head>

<body>
  
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">YOURtime</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact us</a>
          </li>
        </ul>
        <!-- <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success mx-2" type="submit">Search</button>
        </form> -->
        <h4 class="my-2 text-center text-white"><span class="text-success">Welcome,</span> <?php echo $_SESSION['username'] ?>!</h4>
          <a href="logout.php" class="btn btn-outline-danger mx-3">Logout</a>
      </div>
    </div>
  </nav>
  <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editmodalLabel">Edit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="dashboard.php" method="POST">
            <input type="hidden" id="snoedit" name="snoedit">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleedit" name="titleedit" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Note Description</label>
              <textarea class="form-control" id="descriptionedit" name="descriptionedit" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-3">Update</button>
          </form>

        </div>

      </div>
    </div>
  </div>

  <?php
  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been added Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been Updated Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your Note has been Deleted Successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
  }
  ?>
  
  
  <div class="container my-4">
    <h2 class="text-center">Notes will Remind you everything</h2>
    <form action="dashboard.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-3">Add Note</button>
    </form>
  </div>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from `notes_CRUD`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno += 1;
          echo "<tr>
                <th scope='row'>" . $sno . "</th>
                <td>" . $row['title'] . "</td>
                <td>" . $row['description'] . "</td>
                <td>
                <button type='button' class='edit btn btn-primary' data-bs-toggle='modal' data-bs-target='#editmodal' id=" . $row['Sno'] . ">
                Edit
                </button>
                <button type='button' class='delete btn btn-danger' id=d" . $row['Sno'] . " >Delete</button>
                </td>
            </tr>";
        }

        ?>
      </tbody>
    </table>
  </div>

  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        descriptionedit.value = description;
        titleedit.value = title;
        snoedit.value = e.target.id;
        console.log(e.target.id);
      })

    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        sno = e.target.id.substr(1, );
        if (confirm("Are you Sure!")) {
          window.location = `dashboard.php?delete=${sno}`;
        }


      })

    })
  </script>
</body>

</html>