<?php
    class datos_actividad{
        public $codigo;
        public $nombre;
        public $id_tipo_actividad;
        public $fecha_registro;
        public $day;
        public $month;
        public $year;
        public $estado_actividad;
        public $observacion;
        public $informe;
        public $evidencia;
        public $fecha_inicio;

        //Funciones Set
        
        public function setCodigo($codigo_actividad)
        {
            $this->codigo = trim($codigo_actividad);
        }
        public function setNombre($nombre_actividad)
        {
            $this->nombre = trim($nombre_actividad);
        }
        public function setIdTipo($id_tipo_actividad)
        {
            $this->id_tipo_actividad = trim($id_tipo_actividad);
        }
        public function setEstadoActividad($estado_actividad)
        {
            $this->estado_actividad = trim($estado_actividad);
        }
        public function setObservacion($observacion)
        {
            $this->observacion = trim($observacion);
        }
        public function setfechaRegistro($fecha_registro)
        {
            $this->fecha_registro = trim($fecha_registro);
        }
        public function setDay($day)
        {
            $this->day = trim($day);
        }
        public function setMonth($month)
        {
            $this->month = trim($month);
        }
        public function setYear($year)
        {
            $this->year = trim($year);
        }
        public function setInforme($informe)
        {
            $this->informe = trim($informe);
        }
        public function setEvidencia($evidencia){
            $this->evidencia = trim($evidencia);
        }
        public function setFechaInicio($fecha_inicio){
            $this->fecha_inicio = trim($fecha_inicio);
        }
    

        //Funciones Get
        public function getCodigo()
        {
            return $this->codigo;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getEstado()
        {
            return $this->estado_actividad;
        }
        public function getObservacion()
        {
            return $this->observacion;
        }
        public function getfecha($fecha_registro)
        {
            return $this->fecha_registro;
        }
        public function getDay($day)
        {
            return $this->day;
        }
        public function getMonth($month)
        {
            return $this->month;
        }
        public function getYear($year)
        {
            return $this->year;
        }
        public function getInforme()
        {
            return $this->informe;
        }
        public function getEvidencia(){
            return $this->evidencia;
        }
        public function getFechaInicio(){
            return $this->fecha_inicio;
        }

        public function getIdTipo()
        {
            return $this->id_tipo_actividad;
        }
    }
?>