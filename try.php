<html>
<head>
  <style>
  table {
    border: 1px solid black;
    width: 1350px;
    border-collapse: collapse;
    margin-top: 150px;
    margin-left: auto;
    margin-right: auto;
  }
  th {
    background-color: #2f5167;
    color: white;
    font-weight: lighter;
    height: 30px;
  }

  th, td {
    text-align: center;
    padding: 12px;
  }

  tr:hover {
    background-color: #ddd;
    cursor: pointer;
  }
  </style>
</head>
<body>
<?php
echo "<table>";
echo "<tr><th>Sr no.</th><th>Name</th><th>Email</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:160px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}
$servername = "localhost";
$username = "root";
$password = "9Eo3WnUyWG9ObApV";

try {
  $conn = new PDO("mysql:host=$servername;dbname=bank", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT Sr_no, Name, Email FROM customers ORDER BY Sr_no ASC");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</body>
</html>
