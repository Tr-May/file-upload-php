<?php
include_once "upload.php";
include_once "db-conn.php";
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    </head>
  <body>
    <div class="container my-3 bg-light shadow">
        <h2 class="text-center text-info mb-3">Admin Dashboard</h2>
        <?php if (!empty($statusMsg)) { ?>
           <p class="alert alert-<?php echo $status; ?> alert-dismissible">
           <?php echo $statusMsg; ?>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </p> 
       <?php } ?>
        <form method="post" enctype="multipart/form-data" class="pb-3">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload a photo....</label>
                <input class="form-control" name="file" type="file" id="formFile">
            </div>
            <button class="btn btn-info text-white" name="upload-btn">Upload</button>
        </form>
    </div>

    <div class="container my-3">
    <?php
    // Include the database configuration file
    include "db-conn.php";

    // Get images from the database
    $query = $conn->query("SELECT * FROM photo ORDER BY uploaded_at DESC");

    if ($query->num_rows > 0) {
      while ($row = $query->fetch_assoc()) {
        $imageURL = "uploads/" . $row["name"]; ?>
        <img src="<?php echo $imageURL; ?>" alt="" />
        <?php
      }
    } else {
       ?>
            <p>No image(s) found...</p>
        <?php
    }
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>