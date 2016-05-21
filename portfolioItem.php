<?php include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

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
  $currentInd = 0; //Position of the currently selected ID in the array
  $nextID = 1; //Position of the next ID in the array
  $prevID = 0; //Position of the previous ID in the array
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $tempID = $row["WORK_ID"];
        if($tempID == $id){
          $currentInd = $counter;
        }
        $ids[$counter] = $row["WORK_ID"];
        $counter++;
      }
  }

  //Set ID of next portfolio item
  if($currentInd != ($counter - 1)){
    $tempInd = $currentInd;
    $tempInd++;
    $nextID = $ids[$tempInd];
  } else {
    $nextID = $ids[0];
  }

//Set ID of previous portfolio item
  if($currentInd == 0){
    $prevID = $ids[count($ids) - 1];
  } else {
    $tempInd = $currentInd;
    $tempInd--;
    $prevID = $ids[$tempInd];
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
      $imagesHTML .= '<img class="img-responsive img-portfolioItem" src="' . $img . '">';
      $imagesHTML .= ' </div>';
    }
  }

?>

  <div class="row">
    <div class="col-sm-3">
      <h3><?php echo $title; ?>
        <!--<small><?php echo $project;?></small>-->
      </h3>
    </div>
    <div class="col-sm-9 leftPadding">
      <p><?php echo $description; ?></p>
    </div>
    <div class="row">
      <div class="col-sm-12 scrollContainer">
        <div class="nextPrevContainer">
          <div class="prevButtonContainer">
            <?php echo '<a class="nextButton btnNavigation" href="portfolioItem.php?id=' . $prevID . '"> previous chapter <<</a>'; ?>
          </div>
          <div class="nextButtonContainer">
            <?php echo '<a class="nextButton btnNavigation" href="portfolioItem.php?id=' . $nextID . '"> >> next chapter</a>'; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 imagesContainer">
        <?php echo $imagesHTML; ?>
      </div>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
