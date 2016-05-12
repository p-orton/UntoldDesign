
<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Untold Design</title>
  <link rel="icon" href="/images/Tabby.ico">
  <script>
    //Hides content while loading so it can fade in on completion
    if(document.getElementById){
      document.write('<style type="text/css" media="screen">.hiddenOnLoad{display:none;}</style>');
    }
  </script>
</head>
<body>
  <div class="container">
    <div id="loadingDiv">
      <p id="loadingText"></p>
    </div>
  </div>

  <div class="container hiddenOnLoad" id="mainContainer">
    <div id="logoDiv" class="row">
        <!--<a href="/index.php"><img class="headerLogo img-responsive" src="images/logo.jpg" alt="Logo"></a>-->
        <a href="/index.php"><img class="headerLogo img-responsive" src="images/logo.jpg" alt="Logo"></a>
    </div>
    <br/>
    <div class="row">
      <div id="menuDiv"class="col-sm-2">
        <?php include 'menu.php' ?>
      </div>
    <div id="contentDiv" class="col-sm-10">
<!--Page Content, Footer -->
