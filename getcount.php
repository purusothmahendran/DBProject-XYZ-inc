<?php
$group=$_GET['group'];
$host="localhost";
$username="root";
$password="";
$db_name="employee_db";
$tbl_name=$group;
$count;
$con=mysql_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB"); 
$sql="SELECT COUNT(*) FROM $tbl_name";
$result=mysql_query($sql,$con);
if($result)
{
$value=mysql_fetch_row($result);
$count=$value[0];
}
else{
echo "ERROR";
}
echo"<b>THE NUMBER OF EMPLOYEES IN THIS GROUP IS $count</b>";

?>