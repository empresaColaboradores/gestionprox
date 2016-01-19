<?php
require_once 'ExReg.php';
require_once 'raiz_directorio_principal.php';

/**
 * Esta clase se encarga de  manejar 
 * todas las peticiones sql que se realiza
 * al servidor de BD 
 */
class Database extends mysqli {

    private $ExReg;
    protected static $SERVIDOR = "gestionprox.com";
    protected static $BASE_DATOS = "gestionprox";
    protected static $USUARIO = "rocha";
    protected static $PASSWORD = "ighA95^3!123#";
    
    
    public $id;

    public function __construct($usuario = '', $pass = '') {





        @ parent::__construct(self::$SERVIDOR, self::$USUARIO, self::$PASSWORD, self::$BASE_DATOS);

        $this->ExReg = new ExReg();

        @$this->query("SET NAMES 'utf8'");

        if (mysqli_connect_error()) {
            echo ('<script> alert("Error de Conexion: no se pudo establecer una conexion con la Base de Datos, verifique los datos de usuario por favor")</script>');
            echo('<script>location.href="../index.php"</script>');
            exit;
        }
    }

    public function __destruct() {
        @ parent::close();
    }

    public function desinfeccionDeVariables($param) {

        $param = mb_strtoupper($param, 'UTF-8');
        $param = ExReg::quitar_todos_blancos($param);
        $param = parent::real_escape_string($param);



        return $param;
    }

    /**
     * Funcion que maneja  transacciones,
     * y realiza un rollback en caso de error.
     * funcion que reemplaza la denomianda iniciaTransaccion,
     * la mejora es que esta ultima era de parametros fijos, y ahora 
     * es de parametros variables.
     */
    public function procesaTransacciones() {

        $array = func_get_args();
        $arrayCount = sizeof($array);

        $this->query("begin");
        for ($i = 0; $i < $arrayCount; $i++) {
            $consulta = $this->query($array[$i]);
            if (!$consulta) {
                echo $this->error;
                $this->rollback();
                return false;
                break;
                $i = $arrayCount + 1;
            }
        }

        $this->query("COMMIT");

        return true;
    }

    public function getObjetoExrg() {
        return $this->ExReg;
    }

    

    public function setIdEmpresa($id) {


        if ($this->setIdEmpresaAjax($id)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico para el codigo de empresa")</script>');
            raiz();
            exit();
        }
    }

    public function setIdEmpresaAjax($param) {

        if ($this->ExReg->functionOnlyNumberCodigoResina($param)) {
            $this->id = $param;
            return true;
        }
        return false;
    }

    public function getIdEmpresa() {
        return $this->id;
    }

    public function crearConsultalike($param) {

        if (empty($param)) {
            $param = 'like "%%" ';
        } else {
            $param = "like \"" . $param . "\" ";
        }

        return $param;
    }

    public function crearConsultalikeConPrefijo($param) {

        if (empty($param)) {
            $param = 'like "%%" ';
        } else {
            $param = "like \"%" . $param . "%\" ";
        }

        return $param;
    }

    function getParametroDeBusqueda(Permiso $obj_permiso, Bitacora $bitacora, $maquina) {


        /*
          esta funcion devuelve un parametro de busqueda con el siguiente formato
          like "%%" para el administrador y like"%argumento%" para los otros usuarios
         */

        if ($obj_permiso->isAdministrador()) {
            $maquina = $bitacora->crearConsultalike($maquina);
        } else {

            $maquina = $bitacora->determinarCuantasMaquinasConsultar();
        }

        return $maquina;
    }

}

// fin clase Database
?>
