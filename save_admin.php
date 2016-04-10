<?

$json = $_POST['json'];
$items = json_decode($json, true);
//var_dump($items[0]["workid"]);
for($i = 0; $i < count($items); $i++){
  $workid = $items[$i]["workid"];
  $order = $items[$i]["order"];
  $column = $items[$i]["column"];

  //echo $workid;

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

  $sql = "UPDATE WORK
          SET work_order = '$order',
          work_column = '$column'
          WHERE work_id = '$workid'";

  echo "id: " . $workid . " order: " . $order;
  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();
}

?>
