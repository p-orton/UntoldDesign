<?php include 'header.php'; ?>

<script src="/scripts/jquery.BlackAndWhite.js"></script>

<script>

  $(document).ready(function(){
    $('.titleDiv').hide();

    $('.bwWrapper').BlackAndWhite({
        hoverEffect : true, // default true
        // set the path to BnWWorker.js for a superfast implementation
        webworkerPath : false,
        // to invert the hover effect
        invertHoverEffect: false,
        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
        intensity:1,
        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
            fadeIn: 200, // 200ms for fadeIn animations
            fadeOut: 800 // 800ms for fadeOut animations
        },
        onImageReady:function(img) {
            // this callback gets executed anytime an image is converted
        }
    });

    $('.itemContainer').hover(function(){
      $(this).children('.titleDiv').slideDown();
      //$('.titleDiv').slideDown();
    },
    function(){
      //$('.titleDiv').slideUp();
      $(this).children('.titleDiv').slideUp();
    });
  });
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
      echo '<div class="col-sm-4">';
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo '<div class="itemContainer">';
              echo '  <div class="titleDiv">';
              echo '    <p>' . $row['WORK_TITLE'] . '</br>' . $row['WORK_TYPE'] . '</p>';
              echo '  </div>';
              echo '  <div class="wrapper">';
              echo '  <a class="bwWrapper" href="portfolioItem.php?id=' . $row["WORK_ID"] . '">';
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
