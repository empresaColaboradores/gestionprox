<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once 'Database.php';

class Permiso extends Database {

    const ADMINISTRADOR = 4;
    const MANTENIMIENTO = 2;

    private $perfil;
    private $permiso;

    public function __construct() {

        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function optenerPermisosDeUsuarioEnModulo($modulo) {

        $id_usuario = $this->getIdUsuario($_SESSION['k_userName']);
        $this->next_result();
        $permiso = $this->optenerListadoDePermisos($id_usuario, $modulo);
        $this->permiso = $permiso;
    }

    private function getIdUsuario($usuario) {

        $consulta = $this->query("CALL Usuario_consutlarId('$usuario','$this->id');");
        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_usuario = $row['id_usuario'];

        return $id_usuario;
    }

    public function optenerListadoDePermisos($usuario_id = 0, $recurso_id = 0) {
        $consulta = $this->query("CALL Usuario_validarPermiso('$this->id','$recurso_id','$usuario_id');");
        return $consulta->fetch_object();
    }

    public function setIdPerfilUsuario() {
        $id_usuario = $this->getIdUsuario($_SESSION['k_userName']);
        $this->next_result();
        $this->perfil = $this->getPerfilUsuario($id_usuario);
    }

    private function getPerfilUsuario($usuario_id = 0) {
        $consulta = $this->query("CALL optenerPerfilUsuario('$this->id','$usuario_id');");

        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_perfil = $row['id_perfil'];

        return $id_perfil;
    }

    public function verificaPermisoParaRegistro() {
        return ($this->permiso->agregar == 1);
    }

    public function verificaPermisoParaConsulta() {
        return ($this->permiso->consultar == 1);
    }

    public function verificaPermisoParaEditar() {
        return ($this->permiso->editar == 1);
    }

    public function verificaPermisoParaBorrar() {
        return ($this->permiso->borrar == 1);
    }

    public function isAdministrador() {

        return ($this->perfil == self::ADMINISTRADOR);
    }

    public function isMatto() {

        return ($this->perfil == self::MANTENIMIENTO);
    }

}
