<?php
    include ("../../config/crud.php");
	include ("../../controle/festaControle.php");	
	include ("../../modelo/festaModelo.php");
	include ("../../controle/checksumControle.php");	
	include ("../../modelo/checksumModelo.php");
	include ("../../controle/grupoControle.php");	
	include ("../../modelo/grupoModelo.php");
	
    if($_SERVER['REQUEST_METHOD'] == 'POST') :
		$empresaModelo = new FestaModelo();
		$empresaModelo->__setId($_POST['id']);
		$empresaModelo->__setStatus("excluida");
		
		$checkModelo = new ChecksumModelo();
		$checkModelo->__setChecksum(0);
		  
		$checkControle = new ChecksumControle();
		$checksum = $checkControle->inserirChecksum($checkModelo);
		$empresaModelo->__setChecksum(intval($checksum));
		
		$festaControle = new FestaControle();
		$id = $festaControle->atualizarFesta($empresaModelo);		
		
		date_default_timezone_set("Brazil/East");
		$data = date("Y-m-d H:i:s");
		
		$grupoModelo = new GrupoModelo();
		$grupoModelo->__setId(intval($_POST['id']));
		$grupoModelo->__setFesta(intval($_POST['id']));
		$grupoModelo->__setStatus("fechado");
		$grupoModelo->__setData($data);
			
		$grupoControle = new GrupoControle();
		$idGrupo = $grupoControle->inserirGrupo($grupoModelo);
		
		echo 1;
	 endif;
?>