<?php
$host = 'localhost';
$db = 'whsakila2021';
$user = 'root';
$pass = '';

$connection = mysqli_connect($host, $user, $pass, $db);
// get persentase kategori
$sqlKategori = 'select p.customer_id,c.nama,
       t.bulan,
       max(p.amount)
from fakta_pendapatan p,
     customer c,
     time t
where p.customer_id = c.customer_id and p.time_id = t.time_id
group by t.bulan
order by t.bulan';
$resultKategori = mysqli_query($connection, $sqlKategori);
$dataKategori = [];
$objectKategori = array();
while($row = mysqli_fetch_all($resultKategori)){
    $dataKategori[] = $row;
}
var_dump($dataKategori);
foreach ($dataKategori[0] as $row){

    $objectKategori[] = array(
        'name' => $row[1],
        'y' =>$row[3],
        'month' => $row[2]
    );
}

$jsonKategori = json_encode($objectKategori, JSON_NUMERIC_CHECK);
//$jsonKategori = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$jsonKategori);
