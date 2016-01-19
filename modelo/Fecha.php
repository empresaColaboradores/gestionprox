<?php

class Fecha {

    private $fechaInicial;
    private $fechaFinal;

    public function __construct($fechaInicial, $fechaFinal) {

        $this->setFechaInicial($fechaInicial);
        $this->setFechaFinal($fechaFinal);
        $this->verificarFecha();

       
    }

    private function setFechaInicial($fechaIncial) {


        $fecha = new DateTime();
        $fecha->modify('first day of this month');
        $fechaInicialDefecto=$fecha->format('Y-m-d');

        if (empty($fechaIncial)) {
            $this->fechaInicial = $fechaInicialDefecto;

             
        } else {
            $this->fechaInicial = $fechaIncial;
        }
    }

    private function setFechaFinal($fechaFinal) {

        if (empty($fechaFinal)) {
            $fechaFinal = date("Y-m-d");
            $this->addOneDayToDate($fechaFinal);
        }else{
             $this->fechaFinal=$fechaFinal;
        }
    }

    private function addOneDayToDate($fechaFinal) {
        $nuevafecha = strtotime('+1 day', strtotime($fechaFinal));
        $this->fechaFinal = date('Y-m-d', $nuevafecha);
    }

    /**
     * importar la clase  modal_consulta.php
     * para generar la ventana modal.
     */
    private function verificarFecha() {

        if (!($this->fechaFinal > $this->fechaInicial)) {

            mensajeDeErrorModal('ERROR EN EL RANGO DE FECHA', $subtitulo='', 'La fecha Final debe Ser mayor que La fecha Inicial');
            raiz();
            exit();
        }
    }

    public function getFechaInicial() {
        return $this->fechaInicial;
    }

    public function getFechaFinal() {
        return $this->fechaFinal;
    }

}
