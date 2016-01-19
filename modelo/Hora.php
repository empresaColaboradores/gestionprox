<?php

/* requiere el archivo modal_consulta.php para generar los mensajes en las funciones
 * mensajeDeErrorModal()
 */

class Reloj {

    private $segundo;
    private $minuto;
    private $hora;
    private $totalTiempo;
    private $id_empresa;

    const MINUTOS = 60;

    public function __construct($hora, $minuto, $segundo = 0) {
        $this->segundo = $segundo;
        $this->setHora($hora);
        $this->setMinuto($minuto);
    }

    private function setHora($hora) {
        $this->hora = (int) $hora;
    }

    private function setMinuto($minuto) {
        $this->minuto = (int) $minuto;
    }

    public function isHoraFueraDeRango() {
        if ($this->isHoraMayorQue8()) {
            mensajeDeErrorModal('HORA POR FUERA DEL RANGO PERMITIDO', 'El valor debe ser igual o menor a 8 horas laborales', '');
        }
    }

    private function isHoraMayorQue8() {
        return($this->hora > 8);
    }

    public function isMinutoFueraDeRango() {

        if ($this->isMinutoMayorque60()) {
            mensajeDeErrorModal('MINUTO POR FUERA DEL RANGO PERMITIDO', 'El valor de minuto debe ser menor o igual a 59', '');
        }
    }

    private function isMinutoMayorque60() {

        return ($this->minuto >= 60);
    }

    public function convertirHorasToMinutos() {
        $this->hora = $this->hora * self::MINUTOS;
        $this->totalizarTiempoEnMinutos();
    }

    private function totalizarTiempoEnMinutos() {

        $this->totalTiempo = ($this->hora + $this->minuto) / self::MINUTOS;
    }

    public function getTotalTiempo() {

        return $this->totalTiempo;
    }

    public function setIdEmpresa($param) {
        $this->id_empresa =  (int)$param;
    }
    
     public function getListadoDeTiempoProductivo() {
        return $this->consultarTiemposProductivosRegistrados();
        
    }

    public function consultarTiemposProductivosRegistrados() {

        return ("CALL ListaTiempoProductivo('$this->id_empresa')");
        
    }

}
