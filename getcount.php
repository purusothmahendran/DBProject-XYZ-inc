<?php
$option=$_GET['options'];
$group=$_GET['group'];
$host="localhost";
$username="root";
$password="";
$db_name="employee_db";
$tbl_name;
$count;
$con=mysql_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB"); 
if($option==1)
{
$tbl_name=$group;
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
}
else if($option==2)
{
$tbl_name="employee";
$sql="SELECT COUNT(*) FROM $tbl_name WHERE title='$group'";
$result=mysql_query($sql,$con);
if($result)
{
$value=mysql_fetch_row($result);
$count=$value[0];
}
else{
echo "ERROR";
}
echo"<b>THE NUMBER OF EMPLOYEES WHO HOLD THIS TITLE ARE $count</b>";
}
else if($option==3)
{
$tbl_name="employee";
$sql= "SELECT last_name,employee_id,rank FROM $tbl_name WHERE rank=7";
$result=mysql_query($sql,$con);
if(mysql_num_rows($result)>0)
    {
        echo "<table class='table table-striped' border='2'>
            <tr>
                <th>LAST NAME</th>
                <th>EMPLOYEE ID</th>
                <th>RANK</th>
               
            </tr>";
    }
	while($row = mysql_fetch_array($result))
    {
        $Employee_ID = $row['employee_id'];
        
        echo "<tr>";
		echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $Employee_ID . "</td>";
        echo "<td>" . $row['rank'] . "</td>";
		echo "</tr>";
		}
		echo"</table>";
}

else if($option==4)
{
$tbl_name="employee";
$sql= "SELECT last_name,employee_id,rank,title FROM $tbl_name WHERE rank>=6&&gender='female'";
$result=mysql_query($sql,$con);
if(mysql_num_rows($result)>0)
    {
        echo "<table class='table table-striped' border='2'>
            <tr>
                <th>LAST NAME</th>
                <th>EMPLOYEE ID</th>
                <th>RANK</th>
				<th>TITLE</th>
               
            </tr>";
    }
	while($row = mysql_fetch_array($result))
    {
        $Employee_ID = $row['employee_id'];
        
        echo "<tr>";
		echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $Employee_ID . "</td>";
        echo "<td>" . $row['rank'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "</tr>";
		}
		echo"</table>";
}

else if($option==5)
{
$tbl_name="employee";
$sql="SELECT employee_id FROM $tbl_name WHERE street_name LIKE  '%Campbell Road%' ";
$result=mysql_query($sql,$con);
if(mysql_num_rows($result)>0)
{
echo "<table class='table table-striped' border='2'>
<tr> 
<th>EMPLOYEE_ID</th>
</tr>";

}
while($row=mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['employee_id'] . "</td>";
echo "</tr>";
}
echo "</table>";
}

else if($option==7)
{
$tbl_one="employee";
$tbl_two="employee_phone_numbers";
$sql="SELECT p.employee_id, e.first_name,p.phone_number
FROM employee e,employee_phone_numbers p
WHERE e.employee_id=p.employee_id AND p.employee_id 
IN (

SELECT employee_id
FROM employee_phone_numbers
GROUP BY employee_id
HAVING COUNT( employee_id ) >1
) ";

$result=mysql_query($sql,$con);

if(mysql_num_rows($result)>0)
{
echo "<table class='table table-striped' border='2'>
<tr> 
<th>EMPLOYEE_ID</th>
<th> FIRST NAME</th>
<th>PHONE NUMBER</th>
</tr>";

}
while($row=mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['employee_id'] . "</td>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['phone_number']. "</td>";
echo "</tr>";
}
echo "</table>";

}


?>