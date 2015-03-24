<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Read CSV</title>
    </head>
<body>

<?php

$uploaddir = './uploads/';

$uploadfile = $uploaddir.basename($_FILES['f']['name']);

if (copy($_FILES['f']['tmp_name'], $uploadfile))
{
echo "<h3>Файл успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }


if (($handle = fopen($uploadfile, "r")) !== FALSE) {

    $allData = [];
    
    while (($data = fgetcsv($handle)) !== FALSE) {
	    $allData[] = $data;
    }
    
    fclose($handle);
 
    $entity = $allData[0][0];
    $number = count($allData[0]);
    $yml = [];

    $name = 'employee';
    
    for ($i=2; $i < (count($allData)); $i++) {
	  
	for ($c=0; $c < $number; $c++) {
	   
	  $yml[$entity][$name .($i-2)][$allData[1][$c]]=$allData[$i][$c];
	 
	}
	

    }
        
    var_dump($yml); 
 
}

?> 

</body>
</html>
