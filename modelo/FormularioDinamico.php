<?php

if (!isset($_SESSION)) {
    session_start();
}

require 'FormularioInterfaz.php';

class FormularioDinamico extends Database implements FormularioInterfaz {

    private $valorSelect;
    private $nameSelect;
    private $numeroMaquina;
    private $tipoFormulario;
    private $unidad;
    private $kilo;
    private $velocidad;
    private $metro;
    private $unidadDeMedidaPrincipal;
    private $OjetoFormulario;

    public function __construct() {
        parent::__construct();
    }

    public function setIdEmpresa($id) {
        parent::setIdEmpresa($id);
    }

    public function getText() {
        return $this->getLabel();
    }

    public function getLabelUnidadesKilosAbreviado() {

        if ($this->isKilos()) {
            echo "KGT";
        }
        if ($this->isUnidades()) {
            echo "UNT";
        }

        if ($this->isMetros()) {
            echo "MT";
        }
    }

    public function getToolTipUnidadesKilosAbreviado() {

        if ($this->isKilos()) {
            echo "KILOGRAMOS TEORICOS";
        }
        if ($this->isUnidades()) {
            echo "UNIDADES TEORICAS";
        }

        if ($this->isMetros()) {
            echo "Metros Teoricos";
        }
    }

    public function getToolTipUnidadesKilosProducidoAbreviado() {

        if ($this->isKilos()) {
            echo "KILOGRAMOS PRODUCIDOS";
        }
        if ($this->isUnidades()) {
            echo "UNIDADES PRODUCIDAS";
        }

        if ($this->isMetros()) {
            echo "METROS PRODUCIDOS";
        }
    }

    public function getLabelProduccion() {

        if (($_SESSION['k_userName']) == strtoupper('reproceso')) {
            echo "Material";
        } else {

            echo "Ficha";
        }
    }

    public function getSelectOrText() {

        if (($_SESSION['k_userName']) == strtoupper('reproceso')) {


            echo '<select id = "material" name = "material" class = "form-control">
                  <option value = "0">Selecciona Uno...</option>
                 </select>';
        } else {

            echo ' <input type = "text" class = "form-control form-inline" maxlength = "7" name = "material" required placeholder = "FICHA TECNICA" value="' . $_SESSION["ficha"] . '">';
        }
    }

    public function getOptionValue() {

        $mysqliResult = $this->establecerNumeroMaquinaDevolverResulset();
        $this->establecerValoresSelect($mysqliResult);
        if ($this->numeroMaquina == 1) {
            return '<option value="' . $this->valorSelect . '">' . $this->nameSelect . '</option>';
        } else {
            return '<option value="0">Selecione una...</option>';
        }
    }

    private function establecerNumeroMaquinaDevolverResulset() {

        $id_area = $this->getIdAreaSegunUsuario();
        $this->next_result();

        $resulSet = $this->consultarListadoDeMaquinasSegunCodigoDeArea($id_area);
        $numeroMAquina = $resulSet->num_rows;

        $this->numeroMaquina = $numeroMAquina;

        return $resulSet;
    }

    private function getIdAreaSegunUsuario() {

        $consulta = $this->consultarAreaSegunusuario($_SESSION['k_userName']);
        $area = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_area = $area["id_area"];
        return $id_area;
    }

    private function consultarAreaSegunusuario($usuario) {
        return $this->query("CALL Bitacora_ConsultaAreaSegunUsuario('$usuario','$this->id');");
    }

    private function consultarListadoDeMaquinasSegunCodigoDeArea($id_area) {
        return $this->query("CALL ListaDesplegableMaquinaSegunArea('$id_area','$this->id');");
    }

    private function establecerValoresSelect($mysqliResult) {

        $row = $mysqliResult->fetch_array(MYSQLI_ASSOC);
        $this->valorSelect = $row["id_maquina"];
        $this->nameSelect = $row["nombre_maquina"];
    }

    public function setTipoFormularioSegunMaquina($id_maquina) {
        $consulta = $this->consultarArbolGerarquicoMaquina($id_maquina);
        $this->tipoFormulario = $consulta->fetch_object();
        $this->next_result();
    }

    private function consultarArbolGerarquicoMaquina($id_maquina) {
        return $this->query("CALL MaquinaconsultarARbolJerarquico('$this->id','$id_maquina');");
    }

    private function consultarUnidadDeMeidaMaquina($id_maquina) {
        return $this->query("CALL MaquinaconsultarUnidadDeMedida('$this->id','$id_maquina');");
    }

    public function setFormularioPesajeProduccion($id_maquina) {
        $consulta = $this->consultarUnidadDeMeidaMaquina($id_maquina);
        $field = $this->field_count - 1;

        $tabla = new Table();
        $tabla->crearArraySimple($consulta, $field);
        $url_arrayOCImp = $tabla->getArray();
        $this->setUnidadesMedidasSEgunMaquina($url_arrayOCImp);
    }

    private function setUnidadesMedidasSEgunMaquina($url_arrayOCImp) {

        foreach ($url_arrayOCImp as $value) {
            foreach ($value as $valor) {

                if ($valor == 1) {
                    $this->unidad = 1;
                }
                if ($valor == 2) {
                    $this->metro = 1;
                }
                if ($valor == 3) {
                    $this->kilo = 1;
                }
                if ($valor == 4) {
                    $this->velocidad = 1;
                }
            }
        }
    }

    public function getFormularioParaPesarProduccion() {
        if ($this->reportaKilosAndUnidades()) {
            $this->showformularioKilosYunidades();
            return;
        }

        if ($this->reportaKilosVelocidadAndMetros()) {
            $this->ShowFormularioMetrosVelocidadKilos();
            return;
            
        }

        if ($this->useFormularioPesajeProduccionVelocidad()) {
            $this->ShowFormularioVelocidad();
            return;
        }
    }

    private function reportaKilosAndUnidades() {

        return $this->useFormularioPesajeProduccionKilos() && $this->useFormularioPesajeProduccionUnidad();
    }

    private function reportaKilosVelocidadAndMetros() {

        return $this->useFormularioPesajeProduccionKilos() &&
                $this->useFormularioPesajeProduccionVelocidad() &&
                $this->useFormularioPesajeProduccionMetros();
    }

    private function showformularioKilosYunidades() {
        echo '<div class="form-group">
                        <label for="exampleInputPassword1">Kilos</label>
                        <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20" name="kilosProducido" required placeholder="Kilos">
                      </div>
                    
                   <div class="form-group">
                        <label for="exampleInputPassword1">Velocidad</label>
                        <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20" name="outPut" required placeholder="Velocidad" value="' . $_SESSION["velocidad"] . '">
                    </div>';
    }

    private function ShowFormularioVelocidad() {
        echo '<div class="form-group">
                        <label for="exampleInputPassword1">Velocidad</label>
                        <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20" name="outPut" required placeholder="Velocidad" value="' . $_SESSION["velocidad"] . '">
                            <input type="hidden"  name="kilosProducido" required placeholder="Kilos" value="0">
                    </div>';
    }

    private function ShowFormularioMetrosVelocidadKilos() {
        echo '<div class="form-group">
                        <label for="exampleInputPassword1">Velocidad</label>
                        <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20" name="outPut" required placeholder="Velocidad" value="' . $_SESSION["velocidad"] . '">
                            <input type="hidden"  name="kilosProducido" required placeholder="Kilos" value="0">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputPassword1">Kilos</label>
                        <input type="text" class="form-control form-inline onlyNumbers"  maxlength="20"  name="kilosProducido" required placeholder="Kilos" value="' . $_SESSION["velocidad"] . '">
                    </div>
                    

                    
';
    }

    private function useFormularioPesajeProduccionUnidad() {
        return ($this->unidad == 1);
    }

    private function useFormularioPesajeProduccionKilos() {
        return ($this->kilo == 1);
    }

    private function useFormularioPesajeProduccionVelocidad() {
        return ($this->velocidad == 1);
    }

    private function useFormularioPesajeProduccionMetros() {
        return ($this->metro == 1);
    }

    public function getFormularioSegunMaquina() {
        $this->getFormularioSegunUsuario();
    }

    public function getFormularioSegunUsuario() {

        if ($this->isFullFormulario()) {
            $this->OjetoFormulario = new FormularioCompleto();
        }
        if ($this->isFormularioSeccionEquipo()) {
            $this->OjetoFormulario = new FormularioBasico();
        }
        if ($this->isFormularioMaquinaSeccion()) {
            $this->OjetoFormulario = new FormularioSimple();
        }
    }

    public function showFormulario() {
        $this->OjetoFormulario->showFormulario();
    }

    private function isFullFormulario() {

        return $this->isFormularioMaquinaSeccion() &&
                $this->isFormularioMaquinaSeccionEquipo() &&
                $this->isFormularioMaquinaSeccionEquipoParte();
    }

    private function isFormularioSeccionEquipo() {

        return $this->isFormularioMaquinaSeccion() &&
                $this->isFormularioMaquinaSeccionEquipo();
    }

    private function isFormularioMaquinaSeccion() {
        return ($this->tipoFormulario->seccion == 1);
    }

    private function isFormularioMaquinaSeccionEquipo() {
        return ($this->tipoFormulario->equipo == 1);
    }

    private function isFormularioMaquinaSeccionEquipoParte() {
        return ($this->tipoFormulario->parte == 1);
    }

    public function cargarTipoFormulario() {



        $consulta = $this->listarTipoFormulario();
        $num_total_registros = $consulta->num_rows;

        if ($num_total_registros > 0) {

            return $this->generarListadoDesplegable($consulta, 'id', 'descripcion');
        } else {
            return false;
        }
    }

    private function listarTipoFormulario() {

        return $this->query("CALL ListarOpcionesFormulario();");
    }

    private function generarListadoDesplegable($mysqliResult, $index1, $index2) {

        $vector = array();

        while ($array = $mysqliResult->fetch_array(MYSQLI_ASSOC)) {
            $indice = $array[$index1];
            $valor = $array[$index2];
            $vector[$indice] = $valor;
        }
        return $vector;
    }

    public function setUnidadMedidaPrincipal() {

        $this->unidadDeMedidaPrincipal = $this->getIdUnidadMedida();
    }

    public function getIdUnidadMedida() {

        $consulta = $this->consultarUnidadProduciconPrincipal();
        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_unidad_producida = $row['id_unidad_producida'];

        return $id_unidad_producida;
    }

    private function consultarUnidadProduciconPrincipal() {


        $id_usuario = $this->getIdNombreUsuario(($_SESSION['k_userName']));
        $this->next_result();
        return $this->query("CALL getIdUnidadDeMedidaPrincipal('$id_usuario',$this->id);");
    }

    private function getIdNombreUsuario($nombreUsuario) {

        $consulta = $this->consultaIdUsuario($nombreUsuario);
        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $id_usuario = $row['id_usuario'];

        return $id_usuario;
    }

    private function consultaIdUsuario($nombreUsuario) {

        return $this->query("CALL Usuario_consutarId('$nombreUsuario',$this->id);");
    }

    public function getLabel() {

        if ($this->isKilos()) {
            echo "Kg Prod";
        }


        if ($this->isUnidades()) {
            echo "Und Prod";
        }

        if ($this->isMetros()) {
            echo "Mts Prod";
        }
    }

    private function isKilos() {

        return ($this->unidadDeMedidaPrincipal == 1);
    }

    private function isUnidades() {

        return ($this->unidadDeMedidaPrincipal == 2);
    }

    private function isMetros() {

        return ($this->unidadDeMedidaPrincipal == 3);
    }

}
