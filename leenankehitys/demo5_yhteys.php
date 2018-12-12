<?php 
$host ="magnesium"; 
$user = "16ajonik"; 
$pass = "salasana"; 
$dbname = "db16ajonik"; 

try  //yritetään ottaa yhteys 
{  
    $yhteys = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass); //luo PDO-olion 
}  
catch(PDOException $e) // jos ei onnistu (poikkeus) 
{  
    echo $e->getMessage(); //antaa ilmoituksen siitä, missä virhe 
} 

$sql = "SELECT * FROM demo4_pelaajat"; 
$vastaus = $yhteys->prepare($sql); 
$vastaus->execute(); 
$vastaukset = $vastaus->fetchAll(PDO::FETCH_ASSOC); 

echo json_encode($vastaukset);
?> 