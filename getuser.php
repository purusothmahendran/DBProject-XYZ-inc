<?php

    $first_name = $_GET['first_name'];      // get the first name

    $host="localhost";
    $username="root";
    $password="";
    $db_name="employee_db";
    $tbl_name="employee";

    // make DB connections
    $con=mysql_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
    mysql_select_db("$db_name")or die("cannot select DB");

    // SQL Query
    $sql="SELECT Employee_ID, First_Name, Last_Name, Title, City, State
            FROM $tbl_name
            WHERE First_Name LIKE '%".$first_name."%'";

    // run the query
    $result = mysql_query($sql,$con);

    // if atleast 1 row is returned, then add the table headers
    if(mysql_num_rows($result)>0)
    {
        echo "<table class='table table-striped'>
            <tr>
                <th>Employee ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Title</th>
                <th>City</th>
                <th>State</th>
                <th>Phone Number</th>
            </tr>";
    }

    // fetch the values
    while($row = mysql_fetch_array($result))
    {
        $Employee_ID = $row['Employee_ID'];
        
        echo "<td>" . $Employee_ID . "</td>";
        echo "<td>" . $row['First_Name'] . "</td>";
        echo "<td>" . $row['Last_Name'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['City'] . "</td>";
        echo "<td>" . $row['State'] . "</td>";

        $sql_phoneNos = "SELECT Phone_Number
                       FROM Employee_Phone_Numbers
                       WHERE Employee_ID = ".$Employee_ID;
        $resultPhoneNumbers = mysql_query($sql_phoneNos);
        $primaryPhoneNumber = "";
        $flagPhoneNumber = 1;
        while($rowPhoneNumbers = mysql_fetch_array($resultPhoneNumbers))
        {
            $temp = $rowPhoneNumbers['Phone_Number'] ;
            if($flagPhoneNumber > 1)
                $primaryPhoneNumber = $primaryPhoneNumber." / " .$temp;
            else
                $primaryPhoneNumber = $temp;
            $flagPhoneNumber++;
        }
                
            

        echo "<td>" . $primaryPhoneNumber . "<td>";
        echo "</tr>";
     }
    echo "</table>";

    mysql_close($con);      // close the connection
?>