<?php include 'header.php'; ?>

<!--<script src="/scripts/jquery.BlackAndWhite.js"></script>-->

<script>


</script>

<div class="row">
  <?php
    require 'dataAccess.php';

    //populate the columns one at a time
    for($i = 1; $i <= 3; $i++){

      //Query to return image paths
      $sql = "SELECT IMAGE.IMAGE_PATH, WORK.WORK_ID, WORK.WORK_TITLE, WORK.WORK_TYPE FROM IMAGE, WORK
              WHERE IMAGE.IMAGE_ID = WORK.MAIN_IMAGE_CC
              AND WORK.WORK_COLUMN = " . $i . "
              ORDER BY WORK.WORK_ORDER";

      $result = getData($sql);

      //Print a column, and each image as a link to the detail page
      //Include WORK_ID in the URL for the item detail page
      echo '<div class="col-sm-4 indexColumn">';
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo '<div class="itemContainer">';
              echo '  <div class="titleDiv btnNavigation">';
              echo '    <a class="btnNavigation hoverTitleLink" href="portfolioItem.php?id=' . $row["WORK_ID"] . '">';
              echo '    <p>' . $row['WORK_TITLE'] . '</br>' . $row['WORK_TYPE'] . '</p>  </a>';
              echo '  </div>';
              echo '  <div class="wrapper">';
              echo '  <a class="bwWrapper btnNavigation" href="portfolioItem.php?id=' . $row["WORK_ID"] . '">';
              echo "    <img class='img-responsive BWFilter' src='" . $row["IMAGE_PATH"] . "'>";
              echo '  </a>';
              echo '  </div>';
              echo '</div>';
          }
      }
      echo '</div>';
    }
  ?>
</div>

<?php include 'footer.php'; ?>
