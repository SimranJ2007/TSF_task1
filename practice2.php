<html>
<head>
  <style>

  html, body, ul, ol, li, h1, h2, h3, h4, h5, h6, p, div {
    margin: 0;
    padding: 0;
  }

  body {
    font-family: sans-serif;
  }

  a {
    text-decoration: none;
  }

  .container {
    max-width: 1170px;
    padding: 0 15px;
    margin: 0 auto;
  }

  header {
    height: 60px;
    width: 100%;
    background-color: #2f5167;
    position: fixed;
    top: 0;
    z-index: 10;
  }

  .header-left {
    float: left;
    padding-top: 15px;
    letter-spacing: 2px;
  }

  .header-left h2 {
    margin-left: 0;
    font-weight: lighter;
  }


  .header-right {
    float: right;
    margin-right: -100px;
  }

  .header-right a {
    line-height: 60px;
    padding: 0 25px;
    color: white;
    display: block;
    float: left;
  }

  .header-right a:hover {
    background-color: rgba(255, 255, 255, 0.3);
  }

  table {
    border: 1px solid black;
    width: 1350px;
    border-collapse: collapse;
    margin-top: 150px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 25px;
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

  h3 {
    font-weight: lighter;
  }

  hr {
    margin-top: 160px;

  }

  button {
    padding: 10px 25px;
    background-color: #808000;
    border: none;
    color: white;
    border-radius: 6px;
    font-size: 17px;
  }

  button:active {
    outline: none;
  }

  footer p {
    color: black;
    font-size: 13px;
  }

  footer {
    margin-top: 350px;
    padding-top: 30px;
    padding-bottom: 20px;
    background-color: #26d0c9;
  }

  .ask {
    text-align: center;
  }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <img src="spark.png" width="60px" height="60px" align="left">
      <div class="header-left">
        <h2>The Sparks Bank</h2>
      </div>
      <div class="header-right">
        <a href="HomePage.php">Home</a>
        <a href="#">About Us</a>
        <a href="#">Login</a>
        <a href="#">Contact Us</a>
      </div>
    </div>
  </header>
  <?php
  echo "<table>";
  echo "<tr><th>Sender</th><th>Receiver</th><th>Amount</th><th>Time</th></tr>";

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
    $stmt = $conn->prepare("SELECT Sender, Receiver, Amount, date_time FROM transfers");
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
  <hr width="50%">
  <br><br>
  <div class="ask">
    <h3>Make another Transaction</h3><br>
    <a href="practice3.php#accept"><button>Click</button></a>
  </div>
  <footer>
      <div class="container">
        <p>Copyright &copy 2021. All Rights Reserved.</p>
      </div>
  </footer>
</body>
</html>
