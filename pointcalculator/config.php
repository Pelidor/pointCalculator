<?php
$servername = 'localhost';
$username = 'calculator';
$password = 'XiHbZ6r0';
$database = 'pointCalculator';

$pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$sql = 'SELECT r.city, d.name, p.position FROM race r JOIN position p ON p.RID = r.RID JOIN driver d ON d.DID = p.DID ORDER BY p.position ASC;';
$result = $pdo->query($sql); 
?>
<h1>Melbourne<h1>
<table>
<tr>
<th>Fahrer</th><th>Position</th>
<tr>
<?php
foreach ($result as $row) {
?>
  <tr>
    <td>
<?php  
    echo $row['name'];
?> 
   </td>
    <td>
<?php  
    echo $row['position'];
?>   
 </td>
 </tr>
<?php
}
?>
</table>
