<?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

<script src="/scripts/ekko-lightbox.min.js"></script>
<script src="/scripts/lightbox.js"></script>
<link rel="stylesheet" type="text/css" href="/styles/ekko-lightbox.min.css">

<?php

  require "dataAccess.php";

  //Get the ID of the selected item
  if($_GET["id"]){
    $id = $_GET["id"];
  }

  //Get the Copy for the selected portfolio item
  $sql = "SELECT WORK_TITLE, WORK_TYPE, WORK_DESCRIPTION FROM WORK
          WHERE WORK_ID = " . $id;
  $result = getData($sql);

  //Store results for presentation in HTML
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $title = $row["WORK_TITLE"];
          $project = $row["WORK_TYPE"];
          $description = $row["WORK_DESCRIPTION"];
      }
  }

  //get the ID of the next portfolio item in the collection (for the "Next Chapter" button)
  $sql = "SELECT WORK_ID FROM WORK
          ORDER BY WORK_ORDER";
  $result = getData($sql);

  $ids = array();
  $counter = 0;
  $cur = 0;
  $nextID = 1;
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $tempID = $row["WORK_ID"];
        if($tempID == $id){
          $cur = $counter;
        }
        $ids[$counter] = $row["WORK_ID"];
        $counter++;
      }
  }

  if($cur != ($counter - 1)){
    $cur++;
    $nextID = $ids[$cur];
  }

  $sql = "SELECT image.IMAGE_PATH, thumb.IMAGE_PATH AS THUMB_PATH FROM
          (SELECT WORK_IMAGE.REC_ID, IMAGE.IMAGE_PATH
          FROM WORK_IMAGE, IMAGE
          WHERE WORK_IMAGE.WORK_ID = $id
          AND WORK_IMAGE.IMAGE_ID = IMAGE.IMAGE_ID
          ) image,(
          SELECT WORK_IMAGE.REC_ID, IMAGE.IMAGE_PATH
          FROM WORK_IMAGE, IMAGE
          WHERE WORK_IMAGE.WORK_ID = $id
          AND WORK_IMAGE.THUMB_ID = IMAGE.IMAGE_ID
          ) thumb WHERE image.REC_ID = thumb.REC_ID";

  $result = getData($sql);

  $imagesHTML = "";

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $img = $row["IMAGE_PATH"];
        $thumb = $row["THUMB_PATH"];
        $imagesHTML .= ' <div class="portfolioItemContainer">';
        $imagesHTML .= '  <a href="' . $img . '" data-toggle="lightbox" data-gallery="portfolioImages"><img class="img-responsive" src="' . $thumb . '"></a>';
        $imagesHTML .= '  <span class="glyphicon glyphicon-zoom-in zoomGlyph"></span>';
        $imagesHTML .= ' </div>';
      }
  }
?>

<div class="row">
  <div class="col-sm-3">
    <h3><? echo $title ?><br/>
      <small><? echo $project ?></small>
    </h3>
    <hr>
    <p><? echo $description ?></p>
    <div class="nextButtonContainer">
      <? echo '<a class="nextButton" href="portfolioItem.php?id=' . $nextID . '"> >> next chapter</a>' ?>
    </div>
  </div>
  <div class="col-sm-9">
    <?php   echo $imagesHTML; ?>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
