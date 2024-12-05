<?php
class persona
{
	public $nombre_persona;
	public $apellido_persona;
	public $cedula;

    //Funciones Set
	public function setNombrePersona($nombre_persona)
	{
      $this->nombre_persona=trim($nombre_persona);
	}
    

	public function setApellidoPersona($apellido_persona)
	{
      $this->apellido_persona=trim($apellido_persona);
	}

	public function setCedula($cedula)
	{
      $this->cedula=trim($cedula);
	}

    //Funciones Get
    public function getNombrePersona()
    {
    return $this->nombre_persona;
    }

    public function getApellidoPersonal()
    {
    return $this->apellido_persona;
    }

    public function getCedula()
    {
    return $this->cedula;
    }
}
?>