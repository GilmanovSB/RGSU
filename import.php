<?php
use app\engine\ImportXML;
use app\engine\UploadXML;
use app\engine\Pet;

if(!empty($_FILES)){
$file = new UploadXML($_FILES);
$file_directory = $file->uploadFile();
$users = (new ImportXML($file_directory))->import();


// 3 задание....
$peopleWithPet = (new Pet())->customQuery("SELECT people_name FROM people WHERE id_people IN (SELECT id_people FROM pets WHERE age>3)");
foreach($peopleWithPet as $people){
    print_r($people['people_name'] . ' имеет животных старше 3х лет');
    echo "</br>";
}
}
echo "<a href='logout.php'>Выйти</a>
<form action='#' method='post' enctype='multipart/form-data'>
<input type='file' name='file' id='file'>
<input type='submit' value='Загрузить'>
</form>";