<html>

<head>
<title>Paginate</title>
</head>
<body>
<form method='get'>
< ? P H P
$connection=Mysql_connect('server','user','pass');
        if(!$connection)
        {
            echo 'connection is invalid';
        }
        else
        {
            Mysql_select_db('DB',$connection);

        }
//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}
//this part goes after the checking of the $_GET var
$fetch = mysql_query("SELECT * FROM sample LIMIT $startrow, 10")or
die(mysql_error());
   $num=Mysql_num_rows($fetch);
        if($num>0)
        {
            echo "<table border=2>";
            echo "<tr><td>ID</td><td>Drug</td><td>quantity</td></tr>";
            for($i=0;$i<$num;$i++)
            {
                $row=mysql_fetch_row($fetch);
                echo "<tr>";
                echo"<td>$row[0]</td>";
                echo"<td>$row[1]</td>";
                echo"<td>$row[2]</td>";
                echo"</tr>";
            }//for
            echo"</table>";'
        }
//now this is the link..
echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'">Next</a>';

$prev = $startrow - 10;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Previous</a>';
? >
</form>
</body>
</html>