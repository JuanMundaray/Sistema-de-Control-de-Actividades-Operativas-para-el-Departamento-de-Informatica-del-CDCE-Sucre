<?php 
require_once('DataBase.php');
require_once('persona.php');

class usuario extends persona
{
	private $id_usuario;
	private $nombre_usuario;
	private $contrasena;
	private $tipo_usuario;
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
            $nombre_personal = $this->nombre_persona;
            $apellido_personal = $this->apellido_persona;
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
            ":contrasena"=>password_hash($contrasena, PASSWORD_DEFAULT),
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
            $nombre_personal = $this->nombre_persona;
            $apellido_personal=$this->apellido_persona;
            $cedula = $this->cedula;
            $departamento_usuario = $this->departamento_usuario;
            $id_usuario=$this->id_usuario;
            $marca_existencia=$this->marca_existencia;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.usuario
            SET 
            tipo_usuario=:tipo_usuario,
            nombre_personal=:nombre_personal,
            apellido_personal=:apellido_personal,
            cedula=:cedula,
            departamento_usuario=:departamento_usuario,
            marca_existencia=:marca_existencia
          	WHERE id_usuario='$id_usuario'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
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
    public function cambiar_clave()
    {
        $resultado = false;
        try{
            $contrasena = $this->contrasena;
            $id_usuario=$this->id_usuario;

            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.usuario
            SET 
            contrasena=:contrasena
          	WHERE id_usuario='$id_usuario'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":contrasena"=>$contrasena));

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


    public function getUsuarios($pagina,$num_resultados,$todos=false)
    {
        $resultado = false;
        try{
            $nombre_usuario = $this->nombre_usuario;
            $id_usuario = $this->id_usuario;
            $cedula = $this->cedula;

            $db = DataBase::getInstance();
            $orden='ASC';
            $consulta = "SELECT 
            usuario.id_usuario,
            usuario.nombre_usuario,
            usuario.nombre_personal,
            usuario.cedula,
            usuario.contrasena,
            usuario.tipo_usuario,
            usuario.fecha_creacion,
            usuario.departamento_usuario,
            usuario.apellido_personal,
            usuario.marca_existencia,
            departamentos.id_departamento,
            departamentos.nombre_departamento
            
            FROM actividades.usuario
            LEFT JOIN actividades.departamentos
            ON usuario.departamento_usuario=departamentos.id_departamento
            WHERE 1=1";

            if(!empty($nombre_usuario)){
                $consulta .=" AND nombre_usuario ILIKE '$nombre_usuario%'";
            }
            if(!empty($id_usuario)){
                $consulta .=" AND id_usuario=$id_usuario";
            }
            if(!empty($cedula)){
                $consulta .=" AND cedula='$cedula'";
            }

            if($todos==false){
                // Si la variable todos, es decir que dice si se quieren extraer a todos los usuarios incluyendo a los eliminados es igual a false, entonces solo se muestran los usuarios existentes
                $consulta .=" AND marca_existencia='true'";
            }

            $consulta.=" ORDER BY fecha_creacion $orden";

            if($pagina==true){
                $punto_inicio=($pagina-1)*$num_resultados; 
                $consulta.=" LIMIT $num_resultados OFFSET $punto_inicio";
            }

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

    public function contarNumRegistros($todos){
        $resultado = false;
        try{
            $nombre_usuario = $this->nombre_usuario;
            $id_usuario = $this->id_usuario;
            $tipo_usuario = $this->tipo_usuario;
            $cedula = $this->cedula;
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM actividades.usuario
            LEFT JOIN actividades.departamentos
            ON usuario.departamento_usuario=departamentos.id_departamento
            WHERE 1=1";

            if(!empty($nombre_usuario)){
                $consulta .=" AND nombre_usuario ILIKE '$nombre_usuario%'";
            }
            if(!empty($id_usuario)){
                $consulta .=" AND id_usuario=$id_usuario";
            }
            if(!empty($tipo_usuario)){
                $consulta .=" AND tipo_usuario='$tipo_usuario'";
            }
            if(!empty($cedula)){
                $consulta .=" AND cedula='$cedula'";
            }
            if($todos==false){
                // Si la variable todos, es decir que dice si se quieren extraer a todos los usuarios incluyendo a los eliminados es igual a false, entonces solo se muestran los usuarios existentes
                $consulta .=" AND marca_existencia='true'";
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


    public function login($nombre_usuario,$contrasena)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();  
            
            //COMPROBAR SI EL USUARIO EXISTE

            $consulta = "SELECT * FROM 
            actividades.usuario
            WHERE nombre_usuario = :nombre_usuario AND marca_existencia=true";

            $resultadoPDO = $db->prepare($consulta);

            $resultadoPDO->execute(array(
            ":nombre_usuario"=>$nombre_usuario));

            $coincidencia=$resultadoPDO->rowCount();
            $usuario_coincidencia=$resultadoPDO->fetchAll();
            
            //SI EL USUARIO EXISTE REALIZAR ESTO

            if ($coincidencia==1) {
                //COMPROBAR SI LA CONTRASEÑA COINCIDE
                if((password_verify($contrasena,$usuario_coincidencia[0]['contrasena'])||($contrasena==$usuario_coincidencia[0]['contrasena']))){
                    $consulta="SELECT * FROM 
                    actividades.usuario
                    LEFT JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento
                    WHERE nombre_usuario = :nombre_usuario";
                    $resultadoPDO = $db->prepare($consulta);
                    $resultadoPDO->execute(array(
                    ":nombre_usuario"=>$nombre_usuario));
                    $resultado=$resultadoPDO->fetchAll();
                    $resultadoPDO->closeCursor();

                    session_start();
                    $_SESSION["tipo_usuario"]=$resultado[0]["tipo_usuario"];
                    $_SESSION["id_usuario"]=$resultado[0]["id_usuario"];
                    $_SESSION["nombre_departamento"]=$resultado[0]["nombre_departamento"];
                    $_SESSION["departamento_usuario"]=$resultado[0]["departamento_usuario"];
                    $_SESSION["nombre_usuario"]=$nombre_usuario;
                    header('location:../View/Dashboard.php');
                    exit();
                }
                //ESTO SUCEDE SI LA CONTRASEÑA NO COINCIDE
                else{
                    echo $usuario_coincidencia[0]['contrasena'];
                    header('location:../View/login.php?ERR_PASSWORD');
                    exit();
                }
            }   

            elseif(empty($resultado)){
                header('location:../View/login.php?ERR_INEXISTENCIA');
                exit();
            }
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }


    public function cerrarSesion()
    {
        $resultado = false;
        try{
            session_start();
            session_destroy();
            header("location:../index.php");
            exit();
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

          date_default_timezone_set('America/Caracas');
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

	public function get_departamento_usuario()
	{
      return $this->departamento_usuario;
	}
}

