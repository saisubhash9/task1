<!DOCTYPE html>
<html>

<head>
<title>Banking</title>
<meta charset="utf-8">
<link href="layout.css" rel="stylesheet" type="text/css" >
</head>

<body id="top">

<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"><br> 
      <h1><a href="index.html">GRIP BANK</a></h1>
    </div>
    <nav id="mainav" class="fl_right"> 
      <ul class="clear">
        <li class="active"><a href="index.html">HOME</a></li>
        <li><a href="view.php">VIEW ALL CUSTOMERS</a></li>
        <li><a href="transactions.php">ALL TRANSACTIONS</a></li>
		<li><a href="transact.html">TRANSFER</a></li>
      </ul>
    </nav>
  </header>
</div>
<br><br>
<?php
   $host        = "host = ec2-54-146-73-98.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = ddc3cm0d8ktiv3";
   $credentials = "user = esmfinxysvwzmi password=e7566881b1a5d947418a9f06e3d50b797698827634de24e72c0dde892bbf70b9";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {

   }
   $sql =<<<EOF
      SELECT * from COMPANY ORDER BY ID;
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } 
   echo "<center>";
   echo "<table>";
   echo "<tr style='background-color: #dddddd;'><td>S.NO</td><td>NAME</td><td>AGE</td><td>ADDRESS</td><td>BALANCE</td></tr>";
   while($row = pg_fetch_row($ret)) {
      echo "<tr><td>". $row[0] ."</td>" ;
      echo "<td>". $row[1] ."</td>" ;
	  echo "<td>". $row[2] ."</td>" ;
	  echo "<td>". $row[3] ."</td>" ;
	  echo "<td>". $row[4] ."</td></tr>" ;
   }
   echo "</table>";
   echo"</center>";
   pg_close($db);
?>

</body>
</html>