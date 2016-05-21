var isPageLoading = true;

//Checks if the current page utilizes the loader
function isLoaderVisible(){
  var pth = window.location.pathname.split("?");
  if(pth[0] == "/index.php" || pth[0] == "/portfolioItem.php" || pth[0] == "/"){
    return true;
  } else{
    return false;
  }
}

(function(){
  var loadingMessage = "";
  var loadingCounter = 0;
  var isWriting = true;

  //Hides content while loading so it can fade in on completion
  if(document.getElementById){
    document.write('<style type="text/css" media="screen">.hiddenOnLoad{display:none;}</style>');
  }

  //If page uses a loader, write the loader to the dom and start the refresh loader routine
  if(isLoaderVisible()){
    document.write('<div class="container"><div id="loadingDiv"><p id="loadingText"></p></div></div>');
    refreshLoader();
  }

  //Recursively adds and deletes "."s until isPageLoading is set to false (after page is fully loaded)
  function refreshLoader(){
    if(isWriting){ //Add periods
      if(loadingCounter < 5){
        loadingMessage += " .";
        loadingCounter++;
      } else {
        loadingCounter = 0;
        isWriting = false;
      }
    } else { // remove periods
      if(loadingCounter < 5){
        loadingMessage = loadingMessage.slice(0, -2);
        loadingCounter++;
      } else {
        loadingCounter = 0;
        isWriting = true;
      }
    }
    document.getElementById("loadingText").innerHTML = loadingMessage;

    if(isPageLoading){
      setTimeout(refreshLoader, 250);
    }
  }
})();