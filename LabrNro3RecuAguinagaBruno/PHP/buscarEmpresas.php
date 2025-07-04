<?php
require_once('empresa.class.php');
$empresas = Empresa::buscoEmpresas();
if (is_null($empresas)) {
    $empresas = [];
}
echo json_encode($empresas);