<html>
<head>
  <title>loggedIn</title>
  <script>
  function Func() {
    alert("Money Transferred!");
  }
  </script>
</head>
<body onload="Func()">
<?php

if($_SERVER["REQUEST_METHOD"]== "POST"){
  $Amount = $_POST['amount'];
  if (empty($Amount)) {
    echo "Name is empty";
  }
}

if(isset($_POST['client'])){
  if(!empty($_POST['bank'])) {
    foreach($_POST['bank'] as $selected){
      $sender=$selected;
    }
  } else {
    echo 'Please select the value.';
  }
}

if(isset($_POST['client'])){
  if(!empty($_POST['bank2'])) {
    foreach($_POST['bank2'] as $select){
      $receiver=$select;
    }
  } else {
    echo 'Please select the value.';
  }
}

$servername = "localhost";
$username = "root";
$password = "9Eo3WnUyWG9ObApV";

try {
   $conn = new PDO("mysql:host=$servername;dbname=bank", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO transfers ( Sender, Receiver, Amount)
   VALUES ('$sender', '$receiver', $Amount)";
   // use exec() because no results are returned
   $conn->exec($sql);
   } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
     }
?>
<?php include 'practice2.php'; ?>
</body>
</html>
