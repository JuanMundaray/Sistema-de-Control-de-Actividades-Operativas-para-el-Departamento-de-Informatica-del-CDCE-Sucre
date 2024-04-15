<?php 
require_once('DataBase.php');

class usuario
{
	private $id_usuario;
	private $nombre_usuario;
	private $contrasena;
	private $tipo_usuario;
	private $nombre_personal;
	private $apellido_personal;
	private $cedula;
	private $departamento_usuario;
    private $fecha_creacion;
    private $marca_existencia;

    public function __construct()
    {
        $this->marca_existencia=true;
    }

	public function guardar_usuario()
    {
        $resultado = false;
        try{
            $nombre_usuario = $this->nombre_usuario;
            $contrasena = $this->contrasena;
            $tipo_usuario = $this->tipo_usuario;
            $nombre_personal = $this->nombre_personal;
            $apellido_personal = $this->apellido_personal;
            $cedula = $this->cedula;
            $departamento_usuario = $this->departamento_usuario;
            $fecha_creacion=$this->fecha_creacion;
            $marca_existencia=$this->marca_existencia;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.usuario(
            nombre_usuario,
            nombre_personal,
            apellido_personal,
            contrasena,
            tipo_usuario,
            cedula,
            departamento_usuario,
            fecha_creacion,
            marca_existencia)
              VALUES (
            :nombre_usuario,
            :nombre_personal,
            :apellido_personal,
            :contrasena,
            :tipo_usuario,
            :cedula,
            :departamento_usuario,
            :fecha_creacion,
            :marca_existencia)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":nombre_usuario"=>$nombre_usuario,
            ":nombre_personal"=>$nombre_personal,
            ":apellido_personal"=>$apellido_personal,
            ":contrasena"=>$contrasena,
            ":tipo_usuario"=>$tipo_usuario,
            ":cedula"=>$cedula,
            ":departamento_usuario"=>$departamento_usuario,
            ":fecha_creacion"=>$fecha_creacion,
            ":marca_existencia"=>$marca_existencia));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            
            echo $objeto->getLine();
            $resultado = false;
        }
        return $resultado; 
    }

    public function modificar_usuario()
    {
        $resultado = false;
        try{
            $contrasena = $this->contrasena;
            $tipo_usuario = $this->tipo_usuario;
            $nombre_personal = $this->nombre_personal;
            $apellido_personal=$this->apellido_personal;
            $cedula = $this->cedula;
            $departamento_usuario = $this->departamento_usuario;
            $id_usuario=$this->id_usuario;
            $marca_existencia=$this->marca_existencia;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.usuario
            SET 
            contrasena=:contrasena,
            tipo_usuario=:tipo_usuario,
            nombre_personal=:nombre_personal,
            apellido_personal=:apellido_personal,
            cedula=:cedula,
            departamento_usuario=:departamento_usuario,
            marca_existencia=:marca_existencia
          	WHERE id_usuario='$id_usuario'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":contrasena"=>$contrasena,
            ":tipo_usuario"=>$tipo_usuario,
            ":nombre_personal"=>$nombre_personal,
            ":apellido_personal"=>$apellido_personal,
            ":cedula"=>$cedula,
            ":departamento_usuario"=>$departamento_usuario,
            "marca_existencia"=>$marca_existencia));
            $resultado=$resultadoPDO->rowCount();
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
            session_start();
            if($_SESSION["id_usuario"]!=$id_usuario){
                $db=DataBase::getInstance();
                $consulta="UPDATE actividades.usuario SET marca_existencia=false WHERE id_usuario=:id_usuario";
                $resultadoPDO = $db->prepare($consulta);
                $resultadoPDO->execute(array(':id_usuario'=>$id_usuario));
                $resultado=$resultadoPDO->rowCount();
                $resultadoPDO->closeCursor();
            }
            if($_SESSION["id_usuario"]==$id_usuario){
                $resultado=array(0);
            }
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado;
    }

    public function getNumRegistros($columna=false,$data_busq=false,$useLIKE=true)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            
            if($columna){
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.usuario WHERE $columna ILIKE '$data_busq%' AND marca_existencia=true";
                }else{
                    $consulta = "SELECT * FROM actividades.usuario WHERE $columna=$data_busq AND marca_existencia=true";
                }
            }     
            else{
                $consulta = "SELECT * FROM actividades.usuario WHERE marca_existencia=true";
            }
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

    public function getNumRegistrosHistorial($columna=false,$data_busq=false,$useLIKE=true)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            
            if($columna){
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.usuario WHERE $columna ILIKE '$data_busq%'";
                }else{
                    $consulta = "SELECT * FROM actividades.usuario WHERE $columna=$data_busq";
                }
            }     
            else{
                $consulta = "SELECT * FROM actividades.usuario";
            }
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
            ON usuario.departamento_usuario=departamentos.id_departamento
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

    public function buscar_usuario($columna,$data_busq,$useLIKE=true,$pagina=false,$num_resultados=false)
    {
        $resultado = false;
        try{
            $data_busq=$data_busq;
            $db = DataBase::getInstance();
            
            if($pagina==true){

                $punto_inicio=($pagina-1)*$num_resultados;  

                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.usuario 
                    INNER JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento WHERE $columna ILIKE '$data_busq%'
                    LIMIT $num_resultados OFFSET $punto_inicio";
                }
                if($useLIKE==false){
                    $consulta = "SELECT * FROM actividades.usuario 
                    INNER JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento WHERE $columna='$data_busq'
                    LIMIT $num_resultados OFFSET $punto_inicio";
                }
            }

            if($pagina==false){
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.usuario 
                    INNER JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento
                    WHERE $columna ILIKE '$data_busq%'";
                }
                if($useLIKE==false){
                    $consulta = "SELECT * FROM actividades.usuario 
                    INNER JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento 
                    WHERE $columna='$data_busq'";
                }
            }

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

    public function login($nombre_usuario,$contrasena)
    {
        $resultado = false;
        try{
            $nombre_usuario=$nombre_usuario;
            $contrasena=$contrasena;
            $db = DataBase::getInstance();  
            $consulta = "SELECT * FROM 
            actividades.usuario
            LEFT JOIN actividades.departamentos
            ON usuario.departamento_usuario=departamentos.id_departamento
            WHERE nombre_usuario = :nombre_usuario
            AND contrasena=:contrasena" ;
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":nombre_usuario"=>$nombre_usuario,
            ":contrasena"=>$contrasena));
            $resultado=$resultadoPDO->fetchAll();
            $correspondientes = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();
            if(empty($resultado)){
                header('location:../View/login.php?noExiste');
                exit();
            }
            if($resultado[0]['marca_existencia']==true){
                if($correspondientes==1){
                    session_start();
                    $_SESSION["tipo_usuario"]=$resultado[0]["tipo_usuario"];
                    $_SESSION["id_usuario"]=$resultado[0]["id_usuario"];
                    $_SESSION["nombre_departamento"]=$resultado[0]["nombre_departamento"];
                    $_SESSION["departamento_usuario"]=$resultado[0]["departamento_usuario"];
                    $_SESSION["nombre_usuario"]=$nombre_usuario;
                    header('location:../View/Dashboard.php');
                    exit();
    
                }

            }else{
                header('location:../View/login.php?noExiste');
                exit();
            }
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }

    public function exportarEXCEL($incluir_eliminados=false){
        
        require '../Plugins/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");

        date_default_timezone_set('America/Lima');
        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $campos=array(
            'id_usuario'=>'ID',
            'nombre_usuario'=>'Nombre de Usuario',
            'nombre_personal'=>'Nombre Personal',
            'apellido_personal'=>'Apellido',
            'cedula'=>'Cedula del Usuario',
            'fecha_creacion'=>'Fecha de Creacion',
            'tipo_usuario'=>'Tipo de Usuario',
            'nombre_departamento'=>'Departamento del Usuario'
        );
        $consulta="SELECT * FROM actividades.usuario
        LEFT JOIN actividades.departamentos
        ON usuario.departamento_usuario=departamentos.id_departamento WHERE 1=1";
        
        if($incluir_eliminados==false){
            $consulta.=' AND marca_existencia=true';
        }

        $export->query($consulta);

        // Formato MS Excel
        $export->to_excel();

        // Construir tabla de datos
        $tabla=$export->build_table($campos);
        
        // Descargar archivo .xls
        $export->download('REPORTE USUARIOS SISTEMA DE CONTROL DE ACTIVIDADES');

        if ($dbhex = $export->get_error()) {
            die($dbhex->getMessage());
          }
    }

    //funciones set
    
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

	public function set_nombre_personal($nombre_personal)
	{
      $this->nombre_personal=trim($nombre_personal);
	}
    

	public function setApellido_personal($apellido_personal)
	{
      $this->apellido_personal=trim($apellido_personal);
	}

	public function set_cedula($cedula)
	{
      $this->cedula=trim($cedula);
	}

	public function set_departamento_usuario($departamento_usuario)
	{
      $this->departamento_usuario=trim($departamento_usuario);
	}

    public function set_fecha_creacion($fecha_creacion)
	{
      $this->fecha_creacion=trim($fecha_creacion);
	}

    public function setMarcaExistencia($marca_existencia)
	{
      $this->marca_existencia=trim($marca_existencia);
	}

    //funciones get

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

	public function getNombre_personal()
	{
      return $this->nombre_personal;
	}

	public function getApellido_personal()
	{
      return $this->apellido_personal;
	}

	public function get_cedula()
	{
      return $this->id_usuario;
	}

	public function get_departamento_usuario()
	{
      return $this->departamento_usuario;
	}
}

