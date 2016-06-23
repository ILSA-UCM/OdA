<? 
include_once(dirname(__FILE__)."/include.php");
$dictP = $visit->util->getRequest();
$secDatID = $dict["SecId"];
$ovID = $dict["ovId"];
$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($secDatID,$ovID);
//var_dump($atrib);
?>

<html>
<head>

<STYLE TYPE="text/css">
        span{ 
        	font-family: Verdana;
  			font-size: 12px;
  		}
</STYLE>



</head>
<body>
	<span><?=utf8_decode($atrib->value);?></span>

</body>

</html>