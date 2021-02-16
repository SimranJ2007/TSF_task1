<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
      margin-left: 3px;
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

   .button {
    background-color: #4CAF50;
    margin: 15px 615px;
    padding: 15px 42px;
    display: inline-block;
    color: white;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    border: none;
    border-radius: 10px;
    box-shadow: 0 7px #1a7940;
    }

    .button:active {
      box-shadow: none;
      transform: translateY(2px);
    }

    form {
      width: 950px;
      background-color: #ddd;
      border: 1px solid #ccc;
      height: 580px;
      margin-top: 100px;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
      padding: 15px 15px;
    }

    select {
      width: 450px;
      border: none;
      background-color: #f1f1f1;
      border-radius: 5px;
      font-size: 13px;
      font-weight: lighter;
    }

    option {
      padding: 13px;
    }

    select:focus {
      outline: none;
    }

    input[type=text] {
      width: 250px;
      margin-left: 40px;
      display: inline;
      padding: 16px 10px;
      border: 1px solid #eee;
      border-radius: 3px;
      font-size: 13px;
      font-weight: lighter;
    }

    input[type=text]:focus {
      outline: none;
    }

    footer p {
      color: black;
      font-size: 13px;
    }

    footer {
      padding-top: 30px;
      padding-bottom: 20px;
      background-color: #26d0c9;
    }

  </style>
  <script>
  function validate() {
    var x = document.forms["myForm"]["amount"].value;
    var z = parseInt(document.getElementById('myBtn').innerHTML);
    if(x == '') {
      alert("Amount must be filled out!");
      document.getElementById('amt').value='';
      return false;
    }
    if (x < 0) {
      alert("Amount entered should be positive!");
      document.getElementById('amt').value='';
      return false;
    }
    if (x > z) {
      alert("Insufficient Funds in your Account!");
      document.getElementById('amt').value='';
      return false;
    }
  }
  </script>
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
  <?php include 'try.php';?>
  <br><br>
  <a href="#accept" class="button">Make a Transfer</a>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "9Eo3WnUyWG9ObApV";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=bank", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT Name, Balance FROM customers ORDER BY Sr_no ASC");
    $stmt->execute();

    $users = $stmt->fetchAll();

    $i=0;

    foreach ($users as $user) {
      if($i>9){
        break;
      }
      $user_name[$i] = $user['Name'];
      $i++;
    }

  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  $conn = null;
  ?>
  <br><br><br>
  <hr style="width:50%">
  <form action="master.php" name="myForm" method="post" id="accept" onsubmit="return validate()">
    <label for="first">From:</label>
    <select id="fclient" onchange="myFunction()" name="bank[]" multiple>
      <option value="Atishya" id="F1"><?php echo $user_name[0]; ?></option>
      <option value="Deep" id="F2"><?php echo $user_name[1]; ?></option>
      <option value="Karan" id="F3"><?php echo $user_name[2]; ?></option>
      <option value="Mitul" id="F4"><?php echo $user_name[3]; ?></option>
      <option value="Nupur" id="F5"><?php echo $user_name[4]; ?></option>
      <option value="Ramesh" id="F6"><?php echo $user_name[5]; ?></option>
      <option value="Simran" id="F7"><?php echo $user_name[6]; ?></option>
      <option value="Soham" id="F8"><?php echo $user_name[7]; ?></option>
      <option value="Umesh" id="F9"><?php echo $user_name[8]; ?></option>
      <option value="Vaidehi" id="F10"><?php echo $user_name[9]; ?></option>
    </select>
    <br><br><br><br><br>
    Current Balance :<p id='myBtn'></p>
    <script>
    function myFunction() {
    var x = document.getElementById("fclient");
    var i = x.selectedIndex;
    var check = x.options[i].text;
    if (check=='Deep') {
      document.getElementById("myBtn").innerHTML='15000';
    }
    else if (check=='Simran') {
      document.getElementById("myBtn").innerHTML='50000';
    }
    else if (check=='Nupur') {
      document.getElementById("myBtn").innerHTML='3000';
    }
    else if (check=='Ramesh') {
      document.getElementById("myBtn").innerHTML='800';
    }
    else if (check=='Mitul') {
      document.getElementById("myBtn").innerHTML='2400';
    }
    else if (check=='Vaidehi') {
      document.getElementById("myBtn").innerHTML='3500';
    }
    else if (check=='Karan') {
      document.getElementById("myBtn").innerHTML='11000';
    }
    else if (check=='Soham') {
      document.getElementById("myBtn").innerHTML='9000';
    }
    else if (check=='Umesh') {
      document.getElementById("myBtn").innerHTML='1000';
    }
    else {
      document.getElementById("myBtn").innerHTML='86000';
    }
    }
    </script>

    <br><br><br>
    <label for="second">To:</label>
    <select id="sclient" onchange="myfunction()" name="bank2[]" multiple>
      <option id="S1"><?php echo $user_name[0]; ?></option>
      <option id="S2"><?php echo $user_name[1]; ?></option>
      <option id="S3"><?php echo $user_name[2]; ?></option>
      <option id="S4"><?php echo $user_name[3]; ?></option>
      <option id="S5"><?php echo $user_name[4]; ?></option>
      <option id="S6"><?php echo $user_name[5]; ?></option>
      <option id="S7"><?php echo $user_name[6]; ?></option>
      <option id="S8"><?php echo $user_name[7]; ?></option>
      <option id="S9"><?php echo $user_name[8]; ?></option>
      <option id="S10"><?php echo $user_name[9]; ?></option>
    </select>
    <script>
    function myfunction() {
    var y = document.getElementById("sclient");
    var j = y.selectedIndex;
    var checked = y.options[j].text;
    }
    </script>
    <input type="text" id="amt" placeholder="Enter Amount.." name="amount">
    <input type="submit" value="Click" name="client">
  </form>
  <footer>
      <div class="container">
        <p>Copyright &copy 2021. All Rights Reserved.</p>
      </div>
  </footer>
  </body>
</html>
