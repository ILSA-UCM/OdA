<?

class ClsCampo extends ClsModelo {
	//El concepto ContaPlus es de 25 caracteres
	var $nombre, $tipo, $configuracion, $orderby, $valores, $idtabla;

	function ClsCampo() {
	}

	function getNombreTabla() {
		return "sam_campos";
	}

	function getCamposUpdate() {
		return "nombre, tipo, configuracion, orderby, valores, idtabla";
	}

	function getOrderBy() {
		$res = "orderby, id, nombre";
		return $res;
	}

	function newInstance() {
		return new ClsCampo();
	}

	function getValoresUpdate() {
		global $visit;
		$res =	'
				nombre = '. $visit->util->getNullString( $this->nombre ) .',
				tipo = '. $visit->util->getNullString( $this->tipo ) .',
				configuracion = '. $visit->util->getNullString( $this->configuracion ) .',
				orderby = '. $visit->util->getNullString( $this->orderby ) .',
				valores = '. $visit->util->getNullString( $this->valores ) .',
				idtabla = '. $visit->util->getNullInteger( $this->idtabla );
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre ) .',
				'. $visit->util->getNullString( $this->tipo ) .',
				'. $visit->util->getNullString( $this->configuracion ) .',
				'. $visit->util->getNullString( $this->orderby ) .',
				'. $visit->util->getNullString( $this->valores ) .',
				'. $visit->util->getNullInteger( $this->idtabla );
		return $res;
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"tipo"=>$this->tipo,
			"configuracion"=>$this->configuracion,
			"orderby"=>$this->orderby,
			"valores"=>$this->valores,
			"idtabla"=>$this->idtabla
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre = $cadena;
		$this->tipo = $cadena;
		$this->configuracion = $cadena;
		$this->orderby = $orderby;
		$this->valores = $valores;
		$this->idtabla = $cadena;
	}	

	function estableceCampos($arr) {
		$this->id = $arr["id"];
		$this->nombre = $arr["nombre"];
		$this->tipo = $arr["tipo"];
		$this->configuracion = $arr["configuracion"];
		$this->orderby = $arr["orderby"];
		$this->valores = $arr["valores"];
		$this->idtabla = $arr["idtabla"];
	}

	function getOnSubmit() {
		$res="";
		if ($this->tipo=="richtext") {
			$res = 'habilitaFilesImagenes(\''. $this->getNombreCampoBD() .'\'); ';
		}
		return $res;
	}


	function getHtmlPopupString($prefix) {
		ob_start();
		$this->getHtmlPopup($prefix);
		$res = ob_get_contents(); 
		ob_end_clean();
		return $res;
	}

	function getHtmlPopup($prefix) {	
		$change=' onchange="cambio(this)"';
		if (($this->tipo=="texto/fecha") || ($this->tipo=="texto/fechahora")) {
			print 
				'<input name="'. $this->getNombreCampoBD() .'" style="width:95px;" type="text" size="10" maxlength="10" value="<?= $visit->util->bbdd2date( $fila->'. $this->getNombreCampoBD() .') ?>"'.$change.'>&nbsp;
				<a href="javascript:show_calendar(\'document.formulario.'. $this->getNombreCampoBD() .'\', document.formulario.'.$this->getNombreCampoBD().'.value);"><IMG src="img/cal.gif" WIDTH="16" HEIGHT="16" BORDER=0 ALT=""></a>';			
		} else if ($this->tipo=="richtext") {
			$editorDocument = 'document.getElementById(\''. $prefix.$this->getNombreCampoBD() .'_richtext\')';
			print '<textarea name="'. $prefix.$this->getNombreCampoBD() .'" style="width:495px; height:200px;"'.$change.'><?= $fila->'. $this->getNombreCampoBD() . "?>" .'</textarea>';				
		} else if ($this->tipo=="memo") {
			print '<textarea name="'. $prefix.$this->getNombreCampoBD() .'" style="width:495px; height=200px;"'.$change.'><?= $fila->'. $this->getNombreCampoBD() . "?>" .'</textarea>';
		} else if ($this->tipo=="download_image") {
			print '
				<table border="0" cellpadding="0" cellspacing="0">
				<? if ($fila->'. $this->getNombreCampoBD() .'!="") { ?>
					<tr>
						<td >
							<INPUT TYPE="hidden" NAME="ubicacion_'. $this->getNombreCampoBD() .'" value ="<?= $fila->'. $this->getNombreCampoBD() .' ?>">
							<IMG id ="img_ubicacion_'. $this->getNombreCampoBD() .'" SRC="<?= $fila->'. $this->getNombreCampoBD() .' ?>" WIDTH="148" HEIGHT="80" BORDER="0" ALT="<?= $fila->'. $this->getNombreCampoBD() .' ?>"><br>
						<td>
						<TD valign="top" border="0"><A HREF="#" onclick="return eliminarImagen(\''. $this->getNombreCampoBD() .'\');"><IMG id ="img_eliminar_'. $this->getNombreCampoBD() .'" SRC="img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
						</TD>
					</tr>
				<? } ?>
				<tr>
					<td align="left">Actualizar:<BR>
						<input type="file" name="'. $this->getNombreCampoBD() .'" size="20" onChange="cambio()" class="inputclass">
						</td>
					</tr>
				</table>
				';
		} else if ($this->tipo=="download") {
			print '
				<table border="1">
					<? if ($fila->'. $this->getNombreCampoBD() .'!="") { ?>
						<tr>
							<td align="right"> Ubicación:</td>
							<td>
									<a href="<?= $fila->'. $this->getNombreCampoBD() .' ?>"><?= $fila->'. $this->getNombreCampoBD() .' ?></a>
							<td>
						</tr>
					<? } ?'.'>
					<tr>
						<td align="right">Actualizar:</td>
						<td>
							<input type="file" name="'. $this->getNombreCampoBD() .'" size="10">
						</td>
					</tr>
				</table>
				';
		} else if ($this->tipo=="combo") {
			print '<? $valores = $fila->getValores'.$this->getNombreCampoFuncion().'(); ?'.'>
				<select name="'. $prefix.$this->getNombreCampoBD() .'"'.$change.' class="lsselectsfiltro">
					<option value="">- 
					<? while (list ($clave, $val) = each ($valores)) { ?'.'>
						<option value="<?= $clave ?>" <? if ($clave==$fila->'. $this->getNombreCampoBD() .') print "selected"; ?>><?= $val ?>
					<? } ?'.'>';
			print '</select>';
		} else if ($this->tipo=="checkmultiple" && $this->nombre=="permisos") {
			print '
			<? $valores = $fila->getValoresPermisos(); ?>
			<?
				$tablas = $visit->dbBuilder->getTablas();
			?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<?= $tablas[$i]->nombre_tabla ?>
					</td>
					<?
						reset($valores);
					?>
					<? while (list ($clave, $val) = each ($valores)) { ?>
						<td>
							<?= $val ?>
						</td>
					<? } ?>
				</tr>
				<? for ($i=0;$i<count($tablas);$i++) { ?>
					<? if ($visit->util->perteneceLista("PERM",$tablas[$i]->configuracion)) { ?>
						<tr>
							<td>
								<?= $tablas[$i]->nombre_tabla ?>
							</td>
							<?
								reset($valores);
							?>
							<? while (list ($clave, $val) = each ($valores)) { ?>
								<td>
									<input type="checkbox" name="permisos_<?= $clave ?>_<?= $tablas[$i]->nombre_tabla ?>" value="<?= $clave ?>_<?= $tablas[$i]->nombre_tabla ?>" <? if ($visit->util->perteneceLista($clave."_".$tablas[$i]->nombre_tabla, $fila->permisos)) print "checked"; ?> onchange="cambio(this)">
								</td>
							<? } ?>
						</tr>
					<? } ?>
				<? } ?>
			</table>
			';
		} else if ($this->tipo=="checkmultiple") {
			print '<? $valores = $fila->getValores'.$this->getNombreCampoFuncion().'(); ?'.'>
					<? while (list ($clave, $val) = each ($valores)) { ?'.'>
						<input type="checkbox" name="'. $prefix.$this->getNombreCampoBD() .'_<?= $clave ?>" value="<?= $clave ?>" <? if ($visit->util->perteneceLista($clave, $fila->'. $this->getNombreCampoBD() .')) print "checked"; ?>'.$change.'><?= $val ?>&nbsp;
					<? } ?'.'>';
			print '
				';
		} else if ($this->tipo=="radio") {
			print '<? $valores = $fila->getValores'.$this->getNombreCampoFuncion().'(); ?'.'>
					<? while (list ($clave, $val) = each ($valores)) { ?'.'>
						<input type="radio" name="'. $prefix.$this->getNombreCampoBD() .'" value="<?= $clave ?>" <? if ($clave==$fila->'. $this->getNombreCampoBD() .') print "checked"; ?>'.$change.'><?= $val ?>&nbsp;
					<? } ?'.'>';
			print '
				';
		} else if ($this->tipo=="check") {
			print '<input type="checkbox" name="'. $prefix.$this->getNombreCampoBD() .'" value="S" <? if ($fila->'. $this->getNombreCampoBD() .'=="S") print "checked"; ?'.'>'.$change.'>';			
		} else if ($this->tipo=="foreign_table") {
			$v = explode("|",$this->valores);
			$tablaExterna = new ClsTabla();
			$tablaExterna->nombre_tabla = $v[0];
			$id = $v[1];
			$nombreMostrar = $v[2];
			print '<? $valores = $visit->dbBuilder->'.$tablaExterna->getNombreFuncionListado().'(); ?'.'>
				<select name="'. $prefix.$this->getNombreCampoBD() .'"'.$change.' class="lsselectsfiltro">
					<option value="">---- VACIO ----
					<? while (list ($clave, $valor) = each ($valores)) { ?'.'>
						<option value="<?= $valor->'.$id.' ?>" <? if ($valor->'.$id.'==$fila->'. $this->getNombreCampoBD() .') print "selected"; ?>><?= $valor->'.$nombreMostrar.' ?>
					<? } ?'.'>';
			print '</select>';
		} else if ($this->tipo=="foreign_table_categoria") {
			$v = explode("|",$this->valores);
			$tablaExterna = new ClsTabla();
			$tablaExterna->nombre_tabla = $v[0];
			$id = $v[1];
			$nombreMostrar = $v[2];
			print '<? 
					$valores = $visit->dbBuilder->'.$tablaExterna->getNombreFuncionListado().'(); 
					$dictFilas = $visit->util->getDict( $valores );
					$sDictFilas = array();
					while (list ($clave, $valor) = each ($dictFilas)) { 
						$nombre ="";
						$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);																	
						for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $dictFilas[$caminoItems[$i]]->nombre;
						$nombre = 
						$sDictFilas[$nombre] = $valor;
					}
					ksort( $sDictFilas );
					$valores = &$sDictFilas;
				
				?'.'>
				<select name="'. $prefix.$this->getNombreCampoBD() .'"'.$change.'>
					<option value="">---- PRINCIPAL ----
					<? while (list ($clave, $valor) = each ($valores)) { ?'.'>						
						<option value="<?= $valor->'.$id.' ?>" <? if ($valor->'.$id.'==$fila->'. $this->getNombreCampoBD() .') print "selected"; ?>><?= $clave ?>
					<? } ?'.'>
				';
			print '</select>';
		} else if ($this->tipo=="foreign_table_multiple") {
			$v = explode("|",$this->valores);
			$tablaExterna = new ClsTabla();
			$tablaExterna->nombre_tabla = $v[0];
			$id = $v[1];
			$nombreMostrar = $v[2];
			print '<? 
					$valores = $visit->dbBuilder->'.$tablaExterna->getNombreFuncionListado().'();
					$camposSeleccionados = ",".$fila->'. $this->getNombreCampoBD() .'.",";
				?'.'>
					<? while (list ($clave, $valor) = each ($valores)) { ?'.'>
						<input type="checkbox" value="<?= $valor->'.$id.' ?>" name="'. $prefix.$this->getNombreCampoBD() .'_valor_<?= $valor->'.$id.' ?>" <? if ( !(strpos($camposSeleccionados, ",".$valor->'.$id.'.",")===FALSE) ) print "checked"; ?>'.$change.'><?= $valor->'.$nombreMostrar.' ?>
					<? } ?'.'>
				';
			print '</select>';
		} else if ($this->tipo=="foreign_table_categoriamultiple") {
			print '<? 
				$valores = $visit->dbBuilder->getCategorias();
				if ( ($fila->idcategorias=="") && ($idcategoria!="") ) $fila->idcategorias=$idcategoria;
				$camposSeleccionados = ",".$fila->idcategorias.",";
			?>
				<? while (list ($clave, $valor) = each ($valores)) { ?>
					<? if ($valores[$clave]->archivo==$fila->getNombreTabla() ) { ?>
						<?
							$vCaminoItems = $visit->util->obtenerCaminoCategoria($visit->options->dictCategorias, "", $valor->id);	
						?>
						<input type="checkbox" value="<?= $valor->id ?>" name="idcategorias_valor_<?= $valor->id ?>" <? if ( !(strpos($camposSeleccionados, ",".$valor->id.",")===FALSE) ) print "checked"; ?>'.$change.'><?= $valor->nombre ?>
							(
							<? for ($i=0;$i<count($vCaminoItems)-1;$i++) {?>
								<? if ($i!=0) { ?>
									>>
								<? } ?>
									<?= $visit->options->dictCategorias[$vCaminoItems[$i]]->nombre ?>
							<? } ?>														
							)
						<br>
					<? } ?>
				<? } ?>
			</select>';
		} else {
			print '<input name="'. $prefix.$this->getNombreCampoBD() .'" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->'. $this->getNombreCampoBD() .') ?>"'.$change.'>';
		}
	}

	function getHtmlJavacript($campo) {
		$res="";
		if (($this->tipo=="texto/fecha") || ($this->tipo=="texto/fechahora")) {
		} else if ($this->tipo=="richtext") {	
		} else if ($this->tipo=="memo") {
		} else if ($this->tipo=="download_image") {
			$res='getElement("'. $campo .'_<%= $i+2 %>_'. $this->getNombreCampoBD() .'href").href="<%= $campos[$i]->'. $this->getNombreCampoBD() .' %>";
			getElement("'. $campo .'_<%= $i+2 %>_'. $this->getNombreCampoBD() .'href").innerHTML="<%= $campos[$i]->'. $this->getNombreCampoBD() .' %>";
			f.'. $campo .'_<%= $i+2 %>_'. $this->getNombreCampoBD() .'ubicacion.value="<%= $campos[$i]->'. $this->getNombreCampoBD() .' %>";';

		} else if ($this->tipo=="download") {
		} else if ($this->tipo=="combo") {
		} else if ($this->tipo=="radio") {
		} else if ($this->tipo=="check") {
		} else if ($this->tipo=="foreign_table") {
		} else if ($this->tipo=="foreign_table_categoria") {
		} else if ($this->tipo=="foreign_table_multiple") {
		} else if ($this->tipo=="foreign_table_categoriamultiple") {
		} else {
		}
		if ($res=="") {
			$res='f.'. $campo .'_<?= $i+2 ?>_'. $this->getNombreCampoBD() .'.value="<?= $campos[$i]->'. $this->getNombreCampoBD() .' ?>";';
		}
		return $res;
	}

	function getFuncionVisualizacion($campo) {
		global $visit;
		$marcasIgual=true;
		if ($campo=="") $campo=$this->nombre;
		if ($this->tipo=="texto/fecha") {
			$res="\$visit->util->bbdd2date(".$campo.")";
		} else if ($this->tipo=="texto/fechahora") {
			$res="\$visit->util->bbdd2datetime(".$campo.")";
		} else if ($this->tipo=="check") {
			$res='
					<? if ($filas[$i]->'.$this->getNombreCampoBD().'=="S"){  ?> 
							<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			';
			$marcasIgual=false;
		} else if ($this->tipo=="combo") {
			$nombre = $this->getNombreCampoBD();
			$funcion = "getValor".$this->getNombreCampoFuncion();
			$funcion = substr($campo, 0, strlen($campo)-strlen($nombre)).$funcion;
			$res=$funcion.'('.$campo.')';
		} else if ($this->tipo=="foreign_table") {
			$v = explode("|",$this->valores);
			$tablaExterna = new ClsTabla();
			$tablaExterna->nombre_tabla = $v[0];
			$id = $v[1];
			$nombreMostrar = $v[2];
			$visit->options->funcionesPrevisualizacion .='$strIds= $visit->util->getIdsFromFilas( $filas, "'.$this->getNombreCampoBD().'" );
$dict'.$tablaExterna->getNombreUcfirst().' = $visit->util->getDict($visit->dbBuilder->getTablaFiltradaFromIds( new '.$tablaExterna->getNombreCls() .'(), "'.$id.'" , $strIds ) );';
			$res='
				<? if ($dict'.$tablaExterna->getNombreUcfirst().'[ $filas[$i]->'.$this->getNombreCampoBD().' ]!="") {?>
					<?= $dict'.$tablaExterna->getNombreUcfirst().'[ $filas[$i]->'.$this->getNombreCampoBD().' ]->'.$nombreMostrar.' ?>
				<? } else { ?>
					&nbsp;
				<? } ?>
			';
			$marcasIgual=false;
		} else if ($this->tipo=="radio") {
			$nombre = $this->getNombreCampoBD();
			$funcion = "getValores".$this->getNombreCampoFuncion();
			$funcion = substr($campo, 0, strlen($campo)-strlen($nombre)).$funcion;
			$res=$funcion.'('.$campo.')';
		} else {
			$res = $campo;	
		}
		if ($marcasIgual && ($res!="")) {
			$res = '<?= '.$res.' ?>';
		}
		return $res;
	}

	function getFuncionConstruyeSQL() {
		if ($this->tipo=="int") {
			$res="getNullInteger";
		} else {
			$res = "getNullString";	
		}
		return $res;
	}

	function getFuncionFiltro() {
		if ($this->tipo=="foreign_table" || $this->tipo=="int" || $this->tipo=="texto/fecha" || $this->tipo=="texto/fechahora" || $this->tipo=="combo" || $this->tipo=="radio" || $this->tipo=="foreign_table_categoria" || $this->tipo=="check")  { 
			$res = "getSQLBusqueda";	
		} else if ( $this->tipo=="foreign_table_multiple" || $this->tipo=="foreign_table_categoriamultiple" ) {
			$res = "getSQLBusquedaLista";
		} else if ( ($this->tipo=="foreign_table_multiple") || ($this->tipo=="foreign_table_categoriamultiple") ) {
			$res = "getSQLBusquedaLista";
		} else {
			$res="getSQLFiltro";
		}
		return $res;
	}

	function getFuncionBeforeSave($campo) {
		if ($this->tipo=="texto/fecha") {
			$res="\$visit->util->date2bbdd(".$campo.")";
		} else if ($this->tipo=="texto/fechahora") {
			$res="\$visit->util->datetime2bbdd(".$campo.")";
		} else {
			$res = "";	
		}
		return $res;
	}

	function getTipoDatos() {
		global $visit;
		$res = $visit->dbBuilder->generarSql->getTipoDatos( $this->tipo );
		return $res;
	}

	function estaEnListado() {
		$res=true;
		$pos = strpos ($this->configuracion, "L");
		if ($pos === false) $res = false;
		return $res;
	}

	function estaEnObligatorio() {
		$res=true;
		$pos = strpos ($this->configuracion, "O");
		if ($pos === false) $res = false;
		return $res;
	}

	function estaEnFiltro() {
		$res=true;
		$pos = strpos ($this->configuracion, "F");
		if ($pos === false) $res = false;
		return $res;
	}

	function tieneValorConfiguracion($valor) {
		$res=true;
		$pos = strpos ($this->configuracion, $valor);
		if ($pos === false) $res = false;
		return $res;
	}

	function estaEnCuadro() {
		$res=true;
		$pos = strpos ($this->configuracion, "C");
		if ($pos === false) $res = false;
		return $res;
	}

	function getNombreCampoTexto() {
		return $this->nombre;
	}

	function getNombreCampoFuncion() {
		$v = explode("_", $this->nombre);
		$res = "";
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		return $res;
	}


	function getNombreCampoBD() {
		$nombre = trim(strtolower( $this->nombre ));
		$v = explode(" ", $nombre);
		$nombre = implode( "_", $v );
		return $nombre;
	}

}

?>