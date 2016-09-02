<?php

$q = $_GET['q'];

$con = mysql_connect('cs-server.usc.edu:9580','root','900125');
if(!$con) {
		die ("unable to connect the server");
	}
mysql_select_db('websale',$con);

$sql="show columns in $q";
$res = mysql_query($sql);
echo "<select name= 'field' onChange=showField(this.value)>";
while($row=mysql_fetch_assoc($res)){
	echo "<option value='".$row['Field']."'>".$row['Field']."</option>;";
}
echo "</select>";


?>