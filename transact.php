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
    <div id="logo" class="fl_left"> <br>
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







<?php 
	$source=$_POST['source'];
	$destination=$_POST['destination'];
	$amount=$_POST['amount'];
   $host        = "host = ec2-54-146-73-98.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = ddc3cm0d8ktiv3";
   $credentials = "user = esmfinxysvwzmi password=e7566881b1a5d947418a9f06e3d50b797698827634de24e72c0dde892bbf70b9";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {

   }
   $sql2=<<<EOF
   select salary from company where name='$source';
EOF;
   $ret = pg_query($db, $sql2);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
   while($row = pg_fetch_row($ret)) {
      $temp=$row[0];
   }
   $ans=$temp-$amount;
   
if ($ans>=0){
	      $sql3=<<<EOF
   select salary from company where name='$destination';
EOF;
   $ret = pg_query($db, $sql3);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
   while($row = pg_fetch_row($ret)) {
      $temp=$row[0];
   }
   $ans2=$temp+$amount;
   
   $sql =<<<EOF
      UPDATE COMPANY set SALARY = '$ans' where name='$source';
EOF;
   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } else {

   }
   
      $sq4 =<<<EOF
      UPDATE COMPANY set SALARY = '$ans2' where name='$destination';
EOF;
   $ret = pg_query($db, $sq4);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   } else {

   }
   
      $sql5 =<<<EOF
      INSERT INTO TRANSACTIONS (SOURCE,DESTINATION,AMOUNT) VALUES('$source','$destination','$amount');

EOF;

   $ret = pg_query($db, $sql5);
   if(!$ret) {
      echo pg_last_error($db);
   } else {

   }
   echo "<center><br><br>";
   echo "<h1>TRANSACTION SUCCESFUL</h1>";
   echo "</center>";
}
else{
	echo "<center><br><br>";
   echo "<h1>INSUFFICIENT FUNDS</h1>";
   echo "</center>";
}


   pg_close($db);
?>

</body>
</html>
