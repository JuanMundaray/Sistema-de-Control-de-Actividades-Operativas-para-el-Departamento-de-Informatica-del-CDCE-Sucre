<?php
require_once('DataBase.php');

$resultado;
$db = DataBase::getInstance();    
$consulta = "SELECT * FROM actividades.actividad 
INNER JOIN actividades.tipo_actividad
ON actividad.id_tipo=tipo_actividad.id_tipo";
$resultadoPDO = $db->query($consulta);
while($data=$resultadoPDO->fetch(PDO::FETCH_ASSOC)){
    $resultado[]=$data;
}
$resultadoPDO->closeCursor();

if(isset($_POST["export_data"])) {
    if(!empty($resultado)) {
        $filename = "libros.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);

        $mostrar_columnas = false;

        foreach($resultado as $libro) {
            if(!$mostrar_columnas) {
                echo implode("\t", array_keys($libro)) . "\n";
                $mostrar_columnas = true;
            }
            echo implode("\t", array_values($libro)) . "\n";
        }

        }else{
            echo 'No hay datos a exportar';
    }
    exit;
}
?>