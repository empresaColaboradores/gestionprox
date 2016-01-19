<?php

if (!isset($_SESSION)) {
    session_start();
}

class Paginacion {

    //put your code here

    private $numero_registros;
    private $numero_filasPorVista;
    private $pagina_actual;
    private $numero_ultimaPagina;
    private $limiteConsulta;
    private $paginationCtrls;
    private $inicioLimite;
    private $nombreFuncion;

    const PRIMERA_PAGINA = 1;

    /* la diferencia esntre setNumeroRegistro y setNumeroRegistroNumRows
     * es que la primera consulta, esta quemada en la base de datos,
     * y la segunda simplemente cuenta los registros de una consulta
     * segun la propuedad myslqi_num_rows, creo que la primera es mas eficiente
     * ya que no devuelve todas las filas sino simplemente un registro.

     * */

    public function setNumeroRegistros($consultaCliente) {

        $rowAlertas = $consultaCliente->fetch_array(MYSQLI_ASSOC);
        $this->numero_registros = $rowAlertas['total'];
    }

    /**
     *  esta funcion se utiliza para saber  el nuemero de registro
     * en una consulta, pero con la propiedad num_rows de la clase 
     * mysqli
     * @param type $consultaCliente
     */
    public function setNumeroRegistroNumRows($consultaCliente) {

        $this->numero_registros = $consultaCliente->num_rows;
    }

    public function getNumero_registro() {
        return $this->numero_registros;
    }

    /**
     * establece el numero de registros que se visualizaran
     * por cada pagina
     */
    public function setNumero_RegistrosPorVista($numero) {
        $this->numero_filasPorVista = preg_replace('#[^0-9]#', '', $numero);
    }

    public function getNumeroRegistroPorPagina() {
        return $this->numero_filasPorVista;
    }

    public function getNumeroUltimoNumeroPagina() {
        $this->numero_ultimaPagina = $this->ultimaPagina();

        if ($this->numero_ultimaPagina < 1) {
            $this->numero_ultimaPagina = 1;
        }
        return $this->numero_ultimaPagina;
    }

    private function ultimaPagina() {

        return ceil($this->getNumero_registro() / $this->getNumeroRegistroPorPagina());
    }

    /**
     * establece el numero de la pagina que se
     * quiere consultar, por defecto es la pagina
     * inicial
     */
    public function peticionGetHTTP() {

        if (isset($_GET['pn'])) {

            $this->pagina_actual = preg_replace('#[^0-9]#', '', $_GET['pn']);
        }

        $this->setNumeroPaginaActual();
        $this->setNumeroUltimaPagina();
    }

    private function setNumeroPaginaActual() {

        if ((!isset($this->pagina_actual)) && (($this->pagina_actual < 1))) {
            $this->pagina_actual = self::PRIMERA_PAGINA;
        }
    }

    private function setNumeroUltimaPagina() {

        if ($this->pagina_actual > $this->numero_ultimaPagina) {

            $this->pagina_actual = $this->numero_ultimaPagina;
        }
    }

    public function getNumeroPaginaActual() {

        return $this->pagina_actual;
    }

    public function setLimite() {

        $this->limiteConsulta = 'LIMIT ' . ($this->pagina_actual - 1) * $this->numero_filasPorVista . ',' . $this->numero_filasPorVista;
    }

    public function setLimiteInicio() {

        $this->inicioLimite = ($this->pagina_actual - 1) * $this->numero_filasPorVista;
    }

    public function getLimiteInicio() {

        return $this->inicioLimite;
    }

    /* funcion por eliminar */

    public function getLimite() {

        return $this->limiteConsulta;
    }

    private function getPreviousPage() {
        return $this->pagina_actual - 1;
    }

    private function getPrimerasCuatroPaginas() {
        return $this->pagina_actual - 4;
    }

    private function makeLinkLastFourPage() {

        $primerasCuatroPaginas = $this->getPrimerasCuatroPaginas();

        for ($i = $primerasCuatroPaginas; $i < $this->pagina_actual; $i++) {
            /* si hay almenos dos pagina se debe agregar la opcion de visualizar las paginas anteriores */
            if ($i > 0) {
                $this->paginationCtrls.= '<a href="#" onclick="' . $this->nombreFuncion . '(' . $i . ')";> ' . $i . ' </a>';
            }// fin i>0
        }
    }

    /**
     * funcion que crea los link para navegar
     * entre las distintas paginas
     */
    function setLinkPaginacion($funcionCliente) {

        $this->nombreFuncion = ( $funcionCliente);

        if ($this->isValidMakeAPreviousLink()) {
            $this->makePreviousLink();
        }


        $this->paginationCtrls .= '' . $this->pagina_actual;

        $this->makeNextLink();


        /**
         * esta seccion de codigo crea la opcion de siguiente pagina makeLinkNextPage
         */
        if ($this->isValidMakeNexLinktPage()) {
            $this->makeLinkNextPage();
        }
    }

    private function isValidMakeAPreviousLink() {

        return ($this->numero_ultimaPagina > 1) && ($this->pagina_actual > 1);
    }

    /* esto es para crear el link previous , cuando se visualiza almenos la segunda pagina */

    private function makePreviousLink() {

        $this->paginationCtrls.= '<a href="#" onclick="' . $this->nombreFuncion . '(' . $this->getPreviousPage() . ')"; >previo</a> &nbsp;&nbsp;';

        $this->makeLinkLastFourPage();
    }

    private function isValidMakeNexLinktPage() {
        return ($this->pagina_actual != $this->numero_ultimaPagina);
    }

    private function makeLinkNextPage() {
        $this->paginationCtrls .= ' <a href="#" onclick="' . $this->nombreFuncion . '(' . $this->getNexPague() . ');" > Siguiente </a> ';
    }

    private function makeNextLink() {

        for ($i = $this->getNexPague(); $i <= $this->numero_ultimaPagina; $i++) {

            $this->paginationCtrls .= '<a href="#" onclick="' . $this->nombreFuncion . '(' . $i . ');"> ' . $i . '</a> &nbsp;';

            if ($this->isEndPage($i)) {
                break;
            }
        }
    }

    private function getNexPague() {

        return $this->pagina_actual + 1;
    }

    private function isEndPage($paginaSiguiente) {
        return ($paginaSiguiente >= $this->getUltimasCuatroPaginas());
    }

    private function getUltimasCuatroPaginas() {

        return $this->pagina_actual + 4;
    }

// fin function set link

    public function getLink() {

        $div = "<div id=\"pagination\">";
        return $div . $this->paginationCtrls . "</div>";
    }

}

?>
