<? 

include_once(dirname(__FILE__)."/include.php");
$visit->debuger->enable(true);

 
ADOLoadCode("mysql");
$conn=&ADONewConnection("mysql");
$conn->Connect("localhost","root","", "mysqlpr");
/**********parte1
$sql="drop table virtual_object";
$rs = $visit->dbBuilder->conn->Execute($sql);  
$sql=" drop table text_data ";

$sql ="CREATE TABLE `virtual_object` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`ispublic` CHAR (1), 
	`name` varchar (255),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$rs = $visit->dbBuilder->conn->Execute($sql);  

$sql=" drop table text_data ";
$visit->dbBuilder->conn->Execute($sql);  

echo $sql."<br> ";
$sql="CREATE TABLE `text_data` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`idov` INTEGER (11), 
	`idseccion` INTEGER (11), 
	`value` varchar (255), 
	`idrecurso` INTEGER (11),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$visit->dbBuilder->conn->Execute($sql);  
echo $sql."<br> ";
$sql=" drop table numeric_data ";
$visit->dbBuilder->conn->Execute($sql);  
echo $sql."<br> ";

$sql="CREATE TABLE `numeric_data` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`idov` INTEGER (11), 
	`idseccion` INTEGER (11), 
	`value` varchar (255), 
	`idrecurso` INTEGER (11),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$visit->dbBuilder->conn->Execute($sql);  
echo $sql."<br> ";

$sql=" drop table controlled_data ";
$visit->dbBuilder->conn->Execute($sql);  

echo $sql."<br> ";
$sql="CREATE TABLE `controlled_data` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`idov` INTEGER (11), 
	`idseccion` INTEGER (11), 
	`value` varchar (255), 
	`idrecurso` INTEGER (11),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$visit->dbBuilder->conn->Execute($sql); 
echo $sql."<br> ";

$sql=" drop table resources ";
$visit->dbBuilder->conn->Execute($sql);  

echo $sql."<br> ";
$sql="CREATE TABLE `resources` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`idov` INTEGER (11), 
	`ordinal` INTEGER (11), 
	`visible` CHAR (1), 
	`iconoov` CHAR (1), 
	`name` varchar (255), 
	`idov_refered` INTEGER (11), 
	`idresource_refered` INTEGER (11), 
	`type` varchar (255),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$visit->dbBuilder->conn->Execute($sql);  
echo $sql."<br> ";

$sql=" select idov, descripcion from objeto_virtual ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];
				$descripcion = $arr["descripcion"];
				$sql2="INSERT INTO `virtual_object` (id) values (".$idov.")";
				$rs = $visit->dbBuilder->conn->Execute($sql2); 
				echo $sql2."<br>";
				$sql2="INSERT INTO `text_data` (idov,value,idseccion) values (".$idov.", '".substr($descripcion, 0, 255)."' ,32 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);
				$i++;
				echo $sql2."<br>";
				//echo substr($descripcion, 0, 255)."<br>";
				 
				
	 }

}





$sql=" select * from etnologia ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];

				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["grupo_etnico"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,78 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				 
				
	 }

}
$sql=" select * from reproducciones ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];

				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["grupo_etnico"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,78 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				 
				
	 }

}
$sql=" select * from arqueologia ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];

				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["grupo_etnico"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,78 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["subunidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,84 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["unidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,83 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["yacimiento"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,82 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["rasgo"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,86 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				 
				
	 }

}
$sql=" select * from agha ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];

				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["grupo_etnico"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,78 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["subunidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,84 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["unidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,83 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["yacimiento"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,82 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["rasgo"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,86 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				 
				
	 }

}
$sql=" select * from material_docente ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];

				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["tema"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,72 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["tipo"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,73 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["unidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,83 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["yacimiento"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,82 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				
				 
				
	 }

}

$sql=" select * from material_documental ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];
				$valor = $arr["rasgo"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,86 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["grupo_etnico"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,78 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["subarea_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,76 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["area_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,74 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["tema"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,72 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["periodo_cultural"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,75 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["cultura"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,77 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["region"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,81 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["pais"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,80 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["tipo"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,73 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["unidad"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,83 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				$valor = $arr["yacimiento"];
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,82 )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				
				 
				
	 }

}






$sql=" select * from atributos_numericos ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];
				$valor = $arr["valor"];
				$atributoNormalizado= $visit->util->normalizeString($arr["nom_atrib"]);
				$atributo = $arr["nom_atrib"];
				$categoria= $visit->util->normalizeString($arr["categoria"]);
				$categoriaNormalizada = $arr["categoria"];
				$unidades = $arr["unidades"];
				if ($categoriaNormalizada=="analisis" && $atributoNormalizado=="proporcion.1") { 
					echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,65 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br> ";
				} else {
						if ($atributoNormalizado=="diametro") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,59 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,60 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
						} else if ($atributoNormalizado=="ancho") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,48 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,55 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";

						} else if ($atributoNormalizado=="largo") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,52 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,58 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
						} else if ($atributoNormalizado=="alto") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,53 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,57 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";

						} else if ($atributoNormalizado=="peso") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,54 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,56 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";

						}  else if ($atributoNormalizado=="grosor") {
							echo $atributoNormalizado.";".$atributo."<br>";
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,104 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$unidades."' ,105 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							echo $sql2."<br> ";

						}
				}
				
				 
				
	 }

}





$sql=" select * from atributos_texto ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {
	$i=0;
	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];
				$valor = $arr["valor"];
				$atributoNormalizado= $visit->util->normalizeString($arr["nom_atrib"]);
				$atributo = $arr["nom_atrib"];
				$categoria = $arr["categoria"];
				$categoriaNormalizada= $visit->util->normalizeString($arr["categoria"]);

				if ($categoriaNormalizada=="analisis") {
						if ($atributoNormalizado=="proporcion.1") {
							$sql2="INSERT INTO `numeric_data` (idov,value,idseccion) values (".$idov.", '".$valor."' , 65)";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							$i++;
							echo "Nº consultas:".$i."*****";
							echo $sql2."<br> ";
						} else if ($atributoNormalizado=="parte del objeto.1"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,63 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							$i++;
							echo "Nº consultas:".$i."*****";
							echo $sql2."<br> ";
						}
				} else if ($categoriaNormalizada=="general") {
						if ($atributoNormalizado=="material" ||   $atributoNormalizado=="tipo de objeto" || $atributoNormalizado=="conservacion"){
							$sql3=" select * from section_data where nombre = '".$atributoNormalizado."' ";
							$rs3 = $visit->dbBuilder->conn->Execute($sql3);  
							if ($rs2) {
								 while ($arr2 = $rs3->FetchRow()) {
									$idSec=$arr2["id"];
									$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,".$idSec." )";
									$rs = $visit->dbBuilder->conn->Execute($sql2);  
									$i++;
									echo "Nº consultas:".$i."*****";
									echo $sql2."<br> ";
								 }
							}

						} else if ($atributoNormalizado=="tec. fabricacion") {
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,35 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							$i++;
							echo "Nº consultas:".$i."*****";
							echo $sql2."<br> ";
						}  else if ($atributoNormalizado=="ref. topografica") {
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,38 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							$i++;
							echo "Nº consultas:".$i."*****";
							echo $sql2."<br> ";
						}  else if ($atributoNormalizado=="titulo de la obra") {
							$sql2="INSERT INTO `text_data` (idov,value,idseccion) values (".$idov.", '".$valor."' ,33 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);  
							$i++;
							echo "Nº consultas:".$i."*****";
							echo $sql2."<br> ";
						} 
					
				} 
				
				 
				
	 }

}
	
************/



/*

$sql=" select * from metadatos order by idov,id";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {
	 
	 $anterior="";
	 
	 while ($arr = $rs2->FetchRow()) {
				$idov = $arr["idov"];
				$ruta = $arr["ruta"];
				$num_ruta = $arr["num_ruta"];
				$contenido = $arr["contenido"];
				$v = explode("/",$ruta);
				//echo $v[count($v)-2]."<br>";
				
				if ($anterior!="") {
						echo $arr["id"]."///".$anterior."******".$contenido."<br>";
						if ($anterior=="N_expediente"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,44 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						} else if ( $visit->util->normalizeString($anterior)=="n_in_letra"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,45 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						} else if ($visit->util->normalizeString($anterior)=="n_antiguo"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,46 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="n_inventario"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,99 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}  else if ($visit->util->normalizeString($anterior)=="seccion/pais"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,80 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="seccion/seccion"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,79 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="seccion/pais/region"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,81 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="seccion/area cultural"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,74 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}  else if ($visit->util->normalizeString($anterior)=="seccion/area cultural/subarea cultural"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,76 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						} else if ($visit->util->normalizeString($anterior)=="seccion/area cultural/periodo cultural"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,75 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="coleccion"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,98 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}  	 else if ($visit->util->normalizeString($anterior)=="status"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,69 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}   else if ($visit->util->normalizeString($anterior)=="papel"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,70 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}  	 else if ($visit->util->normalizeString($anterior)=="catalogo"){
							$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,102 )";
							$rs = $visit->dbBuilder->conn->Execute($sql2);
							echo $sql2."<br><br>";
							$anterior="";

						}  	
				}  else if ( $ruta=="/manifest/metadata/lom/general/catalogentry/langstring") {
					$anterior=$contenido;
					//$sql2="INSERT INTO `text_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,67 )";
					//	$rs = $visit->dbBuilder->conn->Execute($sql2);
					//if ( $visit->util->normalizeString($v[count($v)-2])=="/manifest/metadata/lom/general/description/langstring") {
					//$sql2="INSERT INTO `virtual_object` (id) values (".$idov.")";
					//	$rs = $visit->dbBuilder->conn->Execute($sql2); 
					//echo $sql2."<br>";
				} else if ( $visit->util->normalizeString($contenido)=="n_expediente"){
							$anterior=$contenido;

				} else if ( $visit->util->normalizeString($contenido)=="n_in_letra"){
							$anterior=$contenido;

				}	else if ($visit->util->normalizeString($contenido)=="n_antiguo"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="n_inventario"){
							$anterior=$contenido;

				}	else if ($visit->util->normalizeString($contenido)=="seccion/pais"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="seccion/seccion"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="seccion/pais/region"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="seccion/area cultural"){
							$anterior=$contenido;

				}	else if ($visit->util->normalizeString($contenido)=="seccion/area cultural/subarea cultural"){
							$anterior=$contenido;

				}	else if ($visit->util->normalizeString($contenido)=="seccion/area cultural/periodo cultural"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="coleccion"){
							$anterior=$contenido;

				}   else if ($visit->util->normalizeString($contenido)=="status"){
							$anterior=$contenido;

				}  	else if ($visit->util->normalizeString($contenido)=="papel"){
							$anterior=$contenido;

				}  else if ($visit->util->normalizeString($contenido)=="catalogo"){
							$anterior=$contenido;

				}  		

				if ( $ruta=="/manifest/metadata/lom/general/description/langstring") {
					$sql2="INSERT INTO `text_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' ,67 )";
					$rs = $visit->dbBuilder->conn->Execute($sql2);
				//if ( $visit->util->normalizeString($v[count($v)-2])=="/manifest/metadata/lom/general/description/langstring") {
					$anterior="";
					echo $sql2."<br><br>";
				}
				if ( $ruta=="/manifest/metadata/lom/general/coverage/langstring") {
					$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' , 103)";
					$rs = $visit->dbBuilder->conn->Execute($sql2);
				//if ( $visit->util->normalizeString($v[count($v)-2])=="/manifest/metadata/lom/general/description/langstring") {
					$anterior="";
					echo $sql2."<br><br>";
				}

				if ( $ruta=="/manifest/metadata/lom/lifecycle/contribute/centity/vcard") {
					$sql2="INSERT INTO `controlled_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' , 100)";
					$rs = $visit->dbBuilder->conn->Execute($sql2);
					$anterior="";
					echo $sql2."<br><br>";
				}
				if ( $ruta=="/manifest/metadata/lom/lifecycle/contribute/date/datetime") {
					$sql2="INSERT INTO `text_data` (idov,value,idseccion) values (".$idov.", '".$contenido."' , 101)";
					$rs = $visit->dbBuilder->conn->Execute($sql2);
					$anterior="";
					echo $sql2."<br><br>";
				}
				
					
			
	 }
}

*/
/*
$sql=" select id,value,idov,idseccion,idrecurso,count(*) as cuenta from controlled_data group by value,idov having cuenta>1 ";
$rs = $visit->dbBuilder->conn->Execute($sql);  

if ($rs) {

	 while ($arr = $rs->FetchRow()) {
				$id = $arr["id"];
				$value = $arr["value"];
				$idseccion = $arr["idseccion"];
				$idrecurso = $arr["idrecurso"];
				$idov = $arr["idov"];
				$sql2="delete from `controlled_data` where id=".$id;
				$rs2 = $visit->dbBuilder->conn->Execute($sql2);
				echo $sql2."<br>";
				$sql2="INSERT INTO `controlled_data` (id,idov,idseccion,value,idrecurso) values (".$id.",".$idov.",".$idseccion.",".$value.",".$idrecurso.")";
				$rs2 = $visit->dbBuilder->conn->Execute($sql2); 
				echo $sql2."<br>";
				//echo substr($descripcion, 0, 255)."<br>";
				 
				
	 }

}

$sql=" drop table resources ";
$visit->dbBuilder->conn->Execute($sql);  

echo $sql."<br> ";
$sql="CREATE TABLE `resources` 
(
	`id` INTEGER (11) NOT NULL  AUTO_INCREMENT , 
	`idov` INTEGER (11), 
	`ordinal` INTEGER (11), 
	`visible` CHAR (1), 
	`iconoov` CHAR (1), 
	`name` varchar (255), 
	`idov_refered` INTEGER (11), 
	`idresource_refered` INTEGER (11), 
	`type` varchar (255),
	PRIMARY KEY (id)
) TYPE=MyISAM";
$visit->dbBuilder->conn->Execute($sql);  
echo $sql."<br> ";

$sql=" select * from recursos ";
$rs2 = $visit->dbBuilder->conn->Execute($sql);  

if ($rs2) {

	 while ($arr = $rs2->FetchRow()) {
				$id = $arr["id"];
				$idov = $arr["idov"];
				$nombre = $arr["nom_rec"];
				//$nombreNormalizado= $visit->util->normalizeString($arr["nom_rec"]);
				$nombrePublico = $arr["nom_rec_publico"];
				//$nombrePublicoNormalizado= $visit->util->normalizeString($arr["nom_rec_publico"]);
				$tipoRec = $arr["tipoRec"];
				$descripcion = $arr["descripcion"];
				$visibleNormalizado= $visit->util->normalizeString($arr["visible"]);
				$visible = $arr["visible"];
				$tipo = $arr["tipo"];
				$tipoNormalizado= $visit->util->normalizeString($arr["tipo"]);
				$ruta = $arr["ruta"];
				$idov_refered="";
				$idresource_refered="";
				$prop="";
				$guardar=true;
				if ($tipoNormalizado=="ov") {
					$type="OV";
					$idov_refered=substr($ruta,0,strlen($ruta)-1);
					//$id=$idov_refered;
					$prop="OV".$idov_refered;
					$guardar=false;
				 } else if ($ruta=="/"){
					$type="P";
					$prop="propio";
					$guardar=true;
				 } else {
					$type="F";
					$idresource_refered=substr($ruta,0,strlen($ruta)-1);
					$prop="OV".$idresource_refered;
					$guardar=false;
				}
				if ($visibleNormalizado=="si") $visible="S";
				else $visible="N";

				$sql2="INSERT INTO `resources` (id,idov,visible,name,idov_refered,idresource_refered,type) values (".$id.",".$idov.",'".$visible."', '".$nombre."', '".$idov_refered."', '".$idresource_refered."', '".$type."'  )";
				 $visit->dbBuilder->conn->Execute($sql2); 
				echo $sql2."<br> ";
				//if (guardar) {
					$sql2="INSERT INTO `text_data` (idov,value,idseccion,idrecurso) values (".$idov.", '".$descripcion."' ,50,".$id." )";
					$rs = $visit->dbBuilder->conn->Execute($sql2);  
					echo $sql2."<br> ";
					echo $descripcion."<br>";

					$sql2="INSERT INTO `controlled_data` (idov,value,idseccion,idrecurso) values (".$idov.", '".$nombre."' ,88,".$id." )";
					$rs = $visit->dbBuilder->conn->Execute($sql2);  
					echo $sql2."<br> ";

					$sql2="INSERT INTO `controlled_data` (idov,value,idseccion,idrecurso) values (".$idov.", '".$tipoRec."' ,51,".$id." )";
					$rs = $visit->dbBuilder->conn->Execute($sql2);  
					echo $sql2."<br> ";
					
					if ($tipoNormalizado!="ov") {
						$sql2="INSERT INTO `controlled_data` (idov,value,idseccion,idrecurso) values (".$idov.", '".$tipo."' ,87,".$id." )";
						$rs = $visit->dbBuilder->conn->Execute($sql2);  
						echo $sql2."<br> ";
					}

				//}
				$sql2="INSERT INTO `controlled_data` (idov,value,idseccion,idrecurso) values (".$idov.", '".$prop."' ,89,".$id." )";
				$rs = $visit->dbBuilder->conn->Execute($sql2);  
				echo $sql2."<br> ";
				
				
				
				 
				
	 }

}




$sql=" SELECT * FROM recursos WHERE tipo='jpg' and ruta='/' and nom_rec like '%jpg' ORDER BY idov,id ";
echo $sql."<br>";
$rs = $visit->dbBuilder->conn->Execute($sql);  
$listaIds="";
if ($rs) {
	$i=0;
	 while ($arr = $rs->FetchRow()) {
				$id = $arr["id"];
				$idov = $arr["idov"];
				$nom_rec = $arr["nom_rec"];
				if (!$visit->util->perteneceLista( $idov, $listaIds)) {
					$listaIds.=",".$idov.",";
					$sql2= " update resources set iconoov='S' where name='".$nom_rec."'";
					$rs2 = $visit->dbBuilder->conn->Execute($sql2);
					$i++;
					echo $sql2."****".$i."<br>";

				}
	 }

}
*/
?> 


