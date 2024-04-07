<?php 
require_once('DataBase.php');

class usuario
{
	private $id_usuario;
	private $nombre_usuario;
	private $contrasena;
	private $tipo_usuario;
	private $nombre;
	private $cedula;
	private $departamento;
    private $fecha_creacion;

	public function guardar_usuario()
    {
        $resultado = false;
        try{
            $nombre_usuario = $this->nombre_usuario;
            $contrasena = $this->contrasena;
            $tipo_usuario = $this->tipo_usuario;
            $nombre = $this->nombre;
            $cedula = $this->cedula;
            $departamento = $this->departamento;
            $fecha_creacion=$this->fecha_creacion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.usuario(nombre_usuario,nombre,contrasena,tipo_usuario,
            cedula,id_departamento,fecha_creacion)
              VALUES (
            :nombre_usuario,
            :nombre,
            :contrasena,:tipo_usuario,:cedula,
            :id_departamento,:fecha_creacion)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_usuario"=>$nombre_usuario,
            ":nombre"=>$nombre,":contrasena"=>$contrasena,
            ":tipo_usuario"=>$tipo_usuario,":cedula"=>$cedula,
            ":id_departamento"=>$departamento,":fecha_creacion"=>$fecha_creacion));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function modificar_usuario()
    {
        $resultado = false;
        try{
			$nombre_usuario = $this->nombre_usuario;
            $contrasena = $this->contrasena;
            $tipo_usuario = $this->tipo_usuario;
            $nombre = $this->nombre;
            $cedula = $this->cedula;
            $departamento = $this->departamento;
            $id_usuario=$this->id_usuario;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.usuario
            SET nombre_usuario=:nombre_usuario,contrasena=:contrasena,
            tipo_usuario=:tipo_usuario,nombre=:nombre,cedula=:cedula,
            id_departamento=:id_departamento
          	WHERE id_usuario='$id_usuario'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_usuario"=>$nombre_usuario,
            ":contrasena"=>$contrasena,":tipo_usuario"=>$tipo_usuario,":nombre"=>$nombre,
            ":cedula"=>$cedula,":id_departamento"=>$departamento));
            $resultadoPDO->closeCursor();                   
        } 
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function eliminar_usuario()
    {
        $resultado = false;
        try{
            $id_usuario=$this->id_usuario;
            $db=DataBase::getInstance();
            $consulta="DELETE FROM actividades.usuario WHERE id_usuario=:id_usuario";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':id_usuario'=>$id_usuario));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado;
    }

    public function getNumRegistros()
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();      
            $consulta = "SELECT * FROM actividades.usuario";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }


    public function get_usuario($pagina,$num_resultados)
    {
        $resultado = false;
        try{
            $punto_inicio=($pagina-1)*$num_resultados;
            $db = DataBase::getInstance();
            $order='ASC';
            $consulta = "SELECT * FROM actividades.usuario
            LEFT JOIN actividades.departamentos
            ON usuario.id_departamento=departamentos.id_departamento
            ORDER BY id_usuario ASC
            LIMIT $num_resultados OFFSET $punto_inicio";

            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }

    public function buscar_usuario($parametro,$data_busq)
    {
        $resultado = false;
        try{
            $data_busq=$data_busq;
            $db = DataBase::getInstance();
            $consulta = "SELECT * FROM actividades.usuario 
            INNER JOIN actividades.departamento
            ON usuario.id_departamento=departamento.id_usuario WHERE $parametro LIKE '$data_busq%'";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function buscar_usuario_tipo($data_busq)
    {
        $resultado = false;
        try{
            $data_busq=$data_busq;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.usuario 
            INNER JOIN actividades.departamento
            ON usuario.id_departamento=departamento.id_usuario WHERE tipo_usuario='$data_busq'";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function buscar_usuario_id()
    {
        $resultado = false;
        try{
            $id_usuario=$this->id_usuario;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.usuario 
            INNER JOIN actividades.departamento
            ON usuario.id_departamento=departamento.id_usuario WHERE id_usuario=:id_usuario";
            $resultadoPDO=$db->prepare($consulta);
            $resultadoPDO->execute(array(':id_usuario'=>$id_usuario));
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function autocompletar_nombre()
    {
        $resultado = false;
        try{
            $nombre=$this->nombre;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.usuario 
            INNER JOIN actividades.departamento
            ON usuario.id_departamento=departamento.id_usuario 
            WHERE nombre LIKE '%$nombre%'";
            $resultadoPDO = $db->query($consulta);
            while($data=$resultadoPDO->fetch(PDO::FETCH_ASSOC)){
                $resultado[]=$data['nombre'];
            }
            $resultadoPDO->closeCursor(); 
        }
        
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function login($nombre_usuario,$contrasena)
    {
        $resultado = false;
        try{
            $nombre_usuario=$nombre_usuario;
            $contrasena=$contrasena;
            $db = DataBase::getInstance();  
            $consulta = "SELECT * FROM actividades.usuario
            LEFT JOIN actividades.departamentos
            ON usuario.id_departamento=departamentos.id_departamento
            WHERE nombre_usuario = :nombre_usuario
            AND contrasena=:contrasena" ;
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_usuario"=>$nombre_usuario,":contrasena"=>$contrasena));
            $resultado=$resultadoPDO->fetchAll();
            $correspondientes = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

            if($correspondientes==1){
                session_start();
                $_SESSION["tipo_usuario"]=$resultado[0]["tipo_usuario"];
                $_SESSION["id_usuario"]=$resultado[0]["id_usuario"];
                $_SESSION["nombre_departamento"]=$resultado[0]["nombre_departamento"];
                $_SESSION["id_departamento"]=$resultado[0]["id_departamento"];
                $_SESSION["nombre_usuario"]=$nombre_usuario;
                header('location:../View/Dashboard.php');
                exit();

            }else{
                header('location:../View/login.php?incorrecto');
                exit();
            }
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }
    
	public function set_id_usuario($id_usuario)
	{
      $this->id_usuario=trim($id_usuario);
	}

	public function set_nombre_usuario($nombre_usuario)
	{
      $this->nombre_usuario=trim($nombre_usuario);
	}

	public function set_contrasena($contrasena)
	{
      $this->contrasena=trim($contrasena);
	}

	public function set_tipoUsuario($tipo_usuario)
	{
      $this->tipo_usuario=trim($tipo_usuario);
	}

	public function set_nombre($nombre)
	{
      $this->nombre=trim($nombre);
	}

	public function set_cedula($cedula)
	{
      $this->cedula=trim($cedula);
	}

	public function set_departamento($departamento)
	{
      $this->departamento=trim($departamento);
	}

    public function set_fecha_creacion($fecha_creacion)
	{
      $this->fecha_creacion=trim($fecha_creacion);
	}

	public function get_id()
	{
      return $this->id_usuario;
	}

	public function get_nombre_usu()
	{
      return $this->nombre_usuario;
	}

	public function get_contrasena()
	{
      return $this->contrasena;
	}

	public function get_tipo()
	{
      return $this->tipo_usuario;
	}

	public function get_nombre()
	{
      return $this->nombre;
	}

	public function get_cedula()
	{
      return $this->id_usuario;
	}

	public function get_departamento()
	{
      return $this->departamento;
	}
}

