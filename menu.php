<?php
  //
  function echoActiveClassIfRequestMatches($requestUri){
      $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

      //default to index
      if ($current_file_name == "")
        $current_file_name = "index";

      if ($current_file_name == $requestUri)
        echo 'class="active"';
  }

?>

<?php
echo '
  <nav class="navbar navbar-default" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <li
';
echoActiveClassIfRequestMatches("index");
echo '
        ><a id="btnWorks" class="menuButton" href="/index.php"></a></li></br>
        <li
';
echoActiveClassIfRequestMatches("story");
echo '
        ><a id="btnAbout" class="menuButton" href="/story.php"></a></li></br>
        <li
';
echoActiveClassIfRequestMatches("contact");
echo '
        ><a id="btnContact" class="menuButton" href="/contact.php"></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
';?>
