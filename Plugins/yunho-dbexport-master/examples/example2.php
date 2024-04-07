<?php

/**
 * YunhoDBExport Example 2
 * @package YunhoDBExport
 * @version 1.0.0
 * @author José Luis Quintana <quintana.io>
 * @license MIT
 */

// Requerir librería
require '../src/YunhoDBExport.php';

// Configuración de base de datos
$host = 'localhost';
$name = 'dbtest';
$user = 'root';
$password = '';

// Asignar zona horaria por defecto
date_default_timezone_set('America/Lima');

// Inicializar librería
$export = new YunhoDBExport($host, $name, $user, $password);

// Conectarse a la base de datos MySQL
$export->connect();

// Mapeo de campos para cabecera
$fields = array(
  'id' => 'ID',
  'model_family' => array(
    'label' => 'Modelo de vehículo',
    'mask' => '<a href="https://www.google.com.pe/#safe=off&q=[value]" target="_blank">Ver Modelo</a>'
  ),
  'color' => 'Color',
  'all_quantity' => 'Cantidad Total',
  'current_quantity' => 'Cantidad actual'
);

// Consulta SQL
$export->query("
  SELECT
    id,
    model_family,
    color,
    COUNT(color) AS 'all_quantity',
    SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS 'current_quantity'
  FROM auto
  WHERE model_family = 'Sedan'
  GROUP BY color
  ORDER BY color
");

// Formato MS Excel
$export->to_excel();

// Construir tabla de datos
$export->build_table($fields);

// Descargar archivo .xls
$export->download();

// Control de errores
if ($dbhex = $export->get_error()) {
  die($dbhex->getMessage());
}
