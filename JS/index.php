<?php

header(" Content - Type : text / plain ; charset ='utf -8'") ;
if (isset($_REQUEST['cp'])&&!empty($_REQUEST['cp'])){
    $cp = $_REQUEST['cp'];
    setLocale(LC_TIME,"fr_FR");
    date_default_timezone_set("Europe / Paris");
    $today=strftime('%A %d %B %y',time());
    $hour = date('H:i:s');
    $meteo = array("cp"=>$cp,
                    "jour"=>$today,
                    "heure"=>$hour,
                    "meteo"=>"Il va faire très beau !");
    if($cp=='45000')echo json_encode($meteo,JSON_PRETTY_PRINT);
    elseif ($cp=='13000')echo json_encode($meteo,JSON_PRETTY_PRINT);
    elseif ($cp=='06000')echo json_encode($meteo,JSON_PRETTY_PRINT);
    else {
        $meteo['meteo']="Inconnu";
        echo json_encode($meteo,JSON_PRETTY_PRINT) ;
        }
}



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
