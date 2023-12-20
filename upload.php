<?php
include_once "db-conn.php";

$status = "";
$statusMsg = "";

$targetDir = "uploads/";

if (isset($_POST["upload-btn"])) {
  if (!empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = ["jpg", "png", "jpeg", "gif"];
    if (in_array($fileType, $allowTypes)) {
      // Upload file to server
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert image file name into database
        $insert = $conn->query(
          "INSERT INTO photo (name, uploaded_at) VALUES ('" .
            $fileName .
            "', NOW())"
        );
        if ($insert) {
          $status = "success";
          $statusMsg =
            "The file " . $fileName . " has been uploaded successfully.";
        } else {
          $statusMsg = "File upload failed, please try again.";
        }
      } else {
        $statusMsg = "Sorry, there was an error uploading your file.";
      }
    } else {
      $statusMsg =
        "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
  } else {
    $statusMsg = "Please select a file to upload.";
  }
}
// Display status message
// echo $statusMsg;
?>

