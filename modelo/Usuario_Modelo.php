<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Database.php';
require_once ('raiz_directorio_principal.php');

class Usuario extends Database {

    private $nombre;
    private $tipoEstado;
    private $motivoEstado;
    private $pass1;
    private $pass2;
    private $old_pass;
    private $email;

    public function __construct($usuario = "", $pass = "") {
        parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);


        $this->nombre = "";
        $this->pass1 = "";
        $this->pass2 = "";
        $this->email = "";
    }

    public function setTipoEstado($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumber($param) && ($param >= 0 && $param <= 1 )) {

            $this->tipoEstado = $param;
        } else {
            echo('<script>alert(" Seleccione un tipo de estado valido")</script>');
            echo('<script>location.href="../peticion/set_rules_main.php"</script>');
            exit;
        }
    }

    public function setMotivoEstado($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumber($param) && ($param >= 1 && $param <= 3 )) {

            $this->motivoEstado = $param;
        } else {
            echo('<script>alert(" Seleccione un tipo de estado valido")</script>');
            echo('<script>location.href="../peticion/set_rules_main.php"</script>');
            exit;
        }
    }

    public function setNombreUsuario($param) {



        if ($this->GetObjetoExrg()->letrasYnumeros($param)) {

            $this->nombre = $this->desinfeccionDeVariables($param);
        } else {
            echo('<script>alert(" Escriba un nombre valido para el campo contacto")</script>');
            raiz_amd();
            exit;
        }
    }

    public function compararClaves($pass1, $pass2) {



        if ($pass1 != $pass2) {
            echo('<script>alert("Los valores para el campo clave no coinciden ")</script>');
            raiz_amd();
            exit;
        } else {

            if (isset($pass1[5]) && isset($pass2[5])) {


                $this->pass1 = $this->desinfeccionDeVariables($pass1);
                $this->pass2 = $this->desinfeccionDeVariables($pass2);
            } else {
                echo('<script>alert("Introduzca una clave con minimo 6 digitos ")</script>');
                raiz_amd();
                exit;
            }
        }
    }

    public function relacionarUsuarioEmpresa($id_empresa) {
        return $this->query("CALL Empresa_usuario_relacion('$this->nombre','$id_empresa')");
    }

    public function compararClavesUsuario($pass1, $pass2) {



        if ($pass1 != $pass2) {
            echo('<script>alert("Los valores para el campo clave no coinciden ")</script>');
            raiz_amd();
            exit;
        } else {
            if (isset($pass1[5]) && isset($pass2[5])) {


                $this->pass1 = ($pass1);
                $this->pass2 = ($pass2);
            } else {
                echo('<script>alert("Introduzca una clave con minimo 6 digitos ")</script>');
                raiz_amd();
                exit;
            }
        }
    }

    public function setPassAnterior($pass1) {

        if (isset($pass1[5])) {


            $this->old_pass = ($pass1);
        } else {
            echo('<script>alert("Introduzca una clave con minimo 6 digitos ")</script>');
            raiz_amd();
            exit;
        }// fin del else principal
    }

    public function setEmail($param) {

        $param = parent::desinfeccionDeVariables($param);
        $param = strtolower($param);

        if (!$this->GetObjetoExrg()->functionExpEmail($param)) {
            echo('<script>alert("Escriba un email valido o con el siguiente formato ej:\n nombre@servidor.com\n o que contenga el minimo de caracteres\nej: a@a.co ")</script>');
            raiz_amd();
            exit;
        } else {
            $this->email = $param;
        }
    }

    public function consultarUsuario() {


        $consulta = $this->query("call Usuario_consultaUsuario('$this->nombre','$this->old_pass','$this->id');");
        return $consulta;
    }

    public function cambiarCalve() {

        $consulta = ("call Usuario_cambiarClave('$this->nombre','$this->pass1','$this->id');");
        return $consulta;
    }

    public function cambiarCalvebd() {

        $consulta = ("call Usuario_cambioClaveBd('$this->nombre','$this->pass1');");
        return $consulta;
    }

    public function crearListaDesplegableEstadoUsuario() {

        $this->consulta = ("SELECT estado_usuario.id_estado,
   estado_usuario.nombre_estado
from estado_usuario");


        $consulta = $this->query($this->consulta);


        return $consulta;
    }

    public function cargarEstado() {
        $consulta = $this->crearListaDesplegableEstadoUsuario();
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            $paises = array();
            while ($pais = $consulta->fetch_array(MYSQLI_ASSOC)) {
                $code = $pais["id_estado"];
                $name = $pais["nombre_estado"];
                $paises[$code] = $name;
            }
            return $paises;
        } else {
            return false;
        }
    }

    public function cargarMotivos() {
        $consulta = $this->crearListaDesplegableMotivoEstado();
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            $paises = array();
            while ($pais = $consulta->fetch_array(MYSQLI_ASSOC)) {
                $code = $pais["id_motivo"];
                $name = $pais["detalle"];
                $paises[$code] = $name;
            }
            return $paises;
        } else {
            return false;
        }
    }

    public function crearListaDesplegableMotivoEstado() {

        $this->consulta = ("SELECT motivo.id_motivo, motivo.detalle from motivo;");


        $consulta = $this->query($this->consulta);


        return $consulta;
    }

    public function ConsultaDuplicado() {





        $this->consulta = ("
            
 SELECT 
usuarios.usuario,
usuarios.email
FROM
usuarios
WHERE
usuarios.usuario='$this->nombre'
and usuarios.email='$this->email'
and usuarios.id_empresa='$this->id'    
;
               ");


        $consulta = $this->query($this->consulta);


        return $consulta;
    }

    public function ConsultaNombreDuplicado() {

        return $this->query("CALL Usuario_consultarNombre('$this->nombre','$this->id')");
    }

    public function ConsultaEmailDuplicado() {


        return $this->query("CALL Usuario_consultarEmail('$this->email','$this->id')");
    }

    public function actualizarEstdoUsario() {
        return $this->query("CALL Usuario_CambioEstado('$this->tipoEstado','$this->motivoEstado','$this->nombre','$this->id');");
    }

    function mostrarDatosUsuario() {



        return $this->query(" CALL Usuario_MostrarUsuarioRegistrados($this->id)");
    }

    public function functionRegistrarUsuario($param, $param2) {

        $result = false;

        if (($this->ConsultaDuplicado()->num_rows <= 0)) {


            $result = $this->procesaTransacciones($param, $param2);
        } else {
            echo('<script>alert("Ya existe un Usuario registrados con estos datos ")</script>');
            raiz_amd();
        }

        return $result;
    }

    public function registrarUsuario() {



        return (" CALL Usuario_registrar('$this->nombre','$this->pass1','$this->email','$this->id')");
    }

    public function registrarUsurioPrimeraVez() {

        return (" CALL Usuario_registrarPrimeraVez('$this->nombre','$this->id')");
    }

    public function buscarUsuario() {

        $this->consulta = ("
            SELECT 
usuarios.usuario,
usuarios.password,
usuarios.email,
usuarios.fecha

from 

usuarios
where usuarios.usuario='$this->nombre'
and usuarios.password= md5('$this->pass')
            
");

        return $this->consulta;
    }

    public function consultaEstadoUsuario() {

        // $param = $this->desinfeccionDeVariables($param);

        $this->consulta = "SELECT rmotivo_estado_usuario.id_estado,
    estado_usuario.nombre_estado,
    rmotivo_estado_usuario.id_motivo,
    motivo.detalle,
       rmotivo_estado_usuario.usuario,
    rmotivo_estado_usuario.fecha_cambio

from 
rmotivo_estado_usuario,
estado_usuario,
motivo

where rmotivo_estado_usuario.usuario like '%$this->nombre%'
and rmotivo_estado_usuario.id_estado = estado_usuario.id_estado
and rmotivo_estado_usuario.id_motivo = motivo.id_motivo
";

        return $this->consulta;
    }

    public function consultaEstadoUsuarioPorParametros($nombre, $estado, $motivoEstado) {



        return " CALL Usuario_consultaEstadoUsuario2('$nombre','$estado','$motivoEstado','$this->id')";
    }

    public function setNombreUsuarioAjax($param) {


        if (!$this->GetObjetoExrg()->functionExpContacto($param)) {
            return false;
        } else {
            $this->nombre = $this->desinfeccionDeVariables($param);
            return true;
        }
    }

    public function setEmailAjax($param) {

        if (!$this->GetObjetoExrg()->functionExpEmail($param)) {
            return false;
        } else {
            $this->email = $param;
            return true;
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function consultaNombreUsuario() {

        if (($this->ConsultaNombreDuplicado()->num_rows) <= 0) {
            
             mensajeDeErrorModal($titulo = 'USUARIO INEXISTENTE'
                    , $subtitulo = 'El usuario que intenta Actualizar no existe'
                    , $mensaje = 'consulte el listado de usuarios registrado en el sistema, y  escoja uno del listado');
            exit();

        } 
    }

}

?>
