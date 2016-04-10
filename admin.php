<?php include 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="/styles/styles-admin.css">

<div class="row">
  <div class="col-sm-9">
    <h3>Portfolio Items</h3>
    <hr class="hrQuarter">
  </div>
  <div class="col-sm-3 text-right">
    <button type="button" class="btn btn-default">
      <a class="nextButton" href="">
        <span class="glyphicon glyphicon-plus"></span> add
      </a>
    </button>
  </div>
</div>

<div class="row">
  <div class="col-sm-3">
  </div>
  <div class="connected">
  <?php

    $servername = "localhost";
    $username = "paulorto_untold";
    $password = "gibson89";
    $dbname = "paulorto_untold";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    for($i = 1; $i <= 3; $i++){

      //Pull back each column of images separately
      $sql = "SELECT IMAGE.IMAGE_PATH, WORK.WORK_ID, WORK.WORK_TITLE FROM IMAGE, WORK
              WHERE IMAGE.IMAGE_ID = WORK.MAIN_IMAGE_CC
              AND WORK.WORK_COLUMN = " . $i . "
              ORDER BY WORK.WORK_ORDER";
      $result = $conn->query($sql);

      echo '<div class="col-sm-2">';
      echo '<ol class="simple_with_animation vertical" id="list' . $i . '">';
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              echo '<li id="image_' . $row["WORK_ID"] . '">';
              echo '<a href="portfolioItemEdit.php?id=' . $row["WORK_ID"] . '">';
              echo "<img class='img-responsive img-admin' src='" . $row["IMAGE_PATH"] . "'>";
              echo '</a>';
              //echo $row["WORK_TITLE"];
              echo '</li>';
          }
      }
      echo '</ol>';
      echo '</div>';
    }


    $conn->close();

  ?>
</div>
  <div class="col-sm-3">
    <button id="saveBtn" type="button" class="btn btn-primary">Save</button>
  </div>
</div>

<div class="row">
  <div class="col-sm-9">
    <h3>Other Stuff</h3>
    <hr class="hrQuarter">
  </div>
  <div class="col-sm-3 text-right">

  </div>
</div>

<script src="/scripts/jquery-sortable.js"></script>
<script src="/scripts/admin.js"></script>

<?php include 'footer.php'; ?>
