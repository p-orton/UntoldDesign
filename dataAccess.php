<?php


  //Returns an open database connection
  function getConnection(){
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

    return $conn;
  }

  //Returns a dataset
  function getData($sql){
    $conn = getConnection();
    $result = $conn->query($sql);
    $conn->close();
    return $result;
  }

  //Returns true is SQL executes successfully
  function executeSQL($sql){
    $conn = getConnection();
    $success = FALSE;

    if ($conn->query($sql) === TRUE) {
        $success = TRUE;
    }

    $conn->close();
    return $success;
  }

?>
