<?php
$servername = "localhost";
$username = "mmmcrowd_train";
$password = "EG6hceE;xHh)";

if ( isset($_GET['x']) ) {
   // $2y$10$nqVaTQ/pcIdk7p3kE0aNnONbFdu1M/IEIqyQ8RgN0UNo02lIEyvXG
   // Create connection
   $connection = new mysqli($servername, $username, $password);
    if (!$connection->set_charset("utf8")) {
        die("error in setting character");
    }
   // Check connection
   if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
   }
    $connection->set_charset("utf8");


   $query = $_GET['x'];
   $result = $connection->query($query);
    
   if ( stripos($query, "update") !== false ) {
      if ($connection->query($query) === true) {
         die("Record updated successfully");
       } else {
         die("Error updating record");
       }
   }
   $rowsCount = $result->num_rows;
   $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SQL Queries</title>
   <style>
#results {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#results td, #results th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

#results tr:nth-child(even){background-color: #f2f2f2;}

#results tr:hover {background-color: #ddd;}

#results th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  text-align: center;
}
</style>
</head>
<body>
<table id="results">
<tr style="text-align: center;">
      <?php
      $body = "";
      $counter = 0;
      if ( isset($_GET['x']) ) {
         if ($rowsCount > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               if ( $counter == 0 ) {
                  echo "<tr>";
               }
               $body .= "<tr>"; 
               foreach ( $row as $column => $value ) {
                  if ( $counter == 0 ) {
                     echo "<th>".$column."</th>";
                  }
                  $body .= "<td>".$value."</td>";
               }

               if ( $counter == 0 ) {
                  echo "</tr>";
               }
               $body .= "</tr>";
               $counter++;
            }
         }
      } else {
         echo "<tr><th>Results</th></tr>";
      }
      ?>
   </tr>
   <tr style="text-align: center;">
      <?php
      if ( isset($_GET['x']) ) {
         echo $body;
      } else {
         echo "<td style='color: red;'>No Results Found</td>";
      }
      ?>
   </tr>

</table>
</body>
</html>
