<?php
//Copyright © McAnam.com
	$elemento = $_GET["fichero"];

    $sUrlDescargas = dirname(__FILE__)."/".$elemento;
    $vBarras = array("/", "\\");

    if (file_exists($sUrlDescargas))
    {
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=".basename($elemento));
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($sUrlDescargas));
        readfile($sUrlDescargas);
    }
    else
    {
        echo "<br>Ha sido imposible descargar el fichero";
    }

?> 