<?php

/**
 * esta clase  tiene el objetivo de
 * manejar todo lo relacionado con una ficha tecnica
 * en la aplicacion
 * registro
 * actualizacion
 * la eliminacion no se contempla
 * validando todos los datos recibidos
 * para  mantener  la integridad en todas las transacciones
 *  en caso de presentarse algun error en alguna peticion con respecto
 * a registro o actualizacion de datos de una Ficha Tecnica la clase mostrara
 * un mensaje al uusario del error, si las transacciones son exitosas
 * se muestran los datos registrados o de actualizacion en un formulario de
 * vizualizacion.
 */
require_once 'Database.php';
require_once 'Cliente_Modelo.php';
require_once 'raiz_directorio_principal.php';





class FichaTecnica extends Database {

    private $idFicha;
    private $nombreProducto;
    private $refProducto;
    private $tipoProducto;
    private $codigoProducto;
    private $cantidadMinima;
    private $unidadeDeMedida;
    private $cliente;
    private $nit;
    private $consulta;
    private $codigo_unidad;
    private $nombre_unidad;
    private $nombre_ext;
    private $peso_ficha;
    private $pesoProdcuto;
    private $codigo_formula;
    private $tratamiento;
    private $ancho;
    private $largo;
    private $espesor;

    /**
     *
     * Variable que representa el codigo de los productos 
     * en proceso con que se compone una ficha
     * los posibles valores son:
     * 1.....pelicula principal
     * 2.....ref de fondo
     * 3.....ref de boca
     * 4.....valvula
     * @var int
     */
    private $codigoProductoProceso;
    private $formula;
    private $codigoLamina;

    /**  Localización de los datos sobrecargados.  */

    /**
     * El constructor inicializa una instancia de la clase ExpresionRegular
     * para ser utilizada en la validacion de formatos
     * ademas inicializa una instancia de la clase cliente para
     * manipular sus datos en memoria 
     */
    public function __construct() {
         parent::__construct($_SESSION['k_userName'], $_SESSION['k_userPass']);
        $this->cliente = new Cliente();
       
    }

    public function __destruct() {
        parent::__destruct();
    }
    
    
     /**
     * 
     * funcion que se utiliza para comprobar
     * la existencia de una ficha en la base de dato
     * @param type $param
     * @return type
     */
    public function compruebaExistenciaFicha($param) {
        return $this->query("CALL Ficha_ComprobarExistencia_Ficha('$param')");
        
    }
    
    public function compruebaExistenciaFichaRegistrarOP($param,$id_empresa) {
        return $this->query("CALL Ficha_ComprobarExistencia_Ficha_Bitacora('$param','$id_empresa')");
        
    }
    

    /**
     * 
     * en esta funcion no se filtra el valor de idFicha
     * por que es creada por el  propio sistema 
     * esta funcion esta encargada
     */
    public function setIdFicha($param, $No) {

        /**
         * siempre aumentamos en uno el id de la ficha 
         */
        $No++;
        $param = $param . $No;


        if ($this->GetObjetoExrg()->functionNumAndLet($param)) {
            $this->idFicha = $param;
        } else {
            echo('<script>alert("Escriba un Formato de Ficha Valido eje V001-R001-B0001  ")</script>');
        }
    }

    public function getCodigoUnidadFicha($id_ficha) {
        /* calcula unidad de mendida */
        $rest = substr($id_ficha, 0, 1);

        $rest = strtoupper($rest);

        $salida = (($rest == 'V' || $rest == 'B') ? 'V' : 'R');

        $unidades = (($salida == 'V' || $salida == 'B') ? ' UN' : ' KL');

        return $unidades;
    }

    /**
     * esta funcion establece un valor para el atributo idFicha
     * los valores que se establecen son del tipo alfanumerico
     * Ej: V001
     * devuelve true si lo establece o false sino se pudo establecer
     * un valor
     * @param type $param
     * @return boolean 
     */
    public function setFicha($param) {
        
      

        if ($this->GetObjetoExrg()->functionNumAndLet($param)) {           
           
            $param = $this->desinfeccionDeVariables($param);
            $this->idFicha = $param;
            return true;
        } else {
            return false;
        }
        
        
    }
    
    public function setFichaSinValidar($param) {
        
      

            $this->idFicha = $param;
          
        
        
    }

    public function compruebaExistenciaFormula($param) {
        $this->formula->setIdFormula($param);
    }

    /**
     * funcion que se utiliza en validacion ajax
     * para comprobar si el codigo de formula
     * intruducido en una ficha tecnica
     * existe.
     * @param int $param
     */
    public function compruebaExistenciaFormulaAjax($param) {

        if ($param == '') {
            $param = 0;
        }
        $this->formula->setIdFormulaAjax($param);
    }

    public function getObjetoFormula() {

        return $this->formula;
    }

    /**
     * esta funcion establece un valor para el atributo codigoProducto
     * @param type $param
     * @return boolean 
     */
    public function setCodigoProducto($param) {


        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionOnlyLetter($param)) {
            $this->codigoProducto = $param;
        } else {
            echo('<script>alert("Escriba un tipo de producto valido ")</script>');
           raiz();
        }
    }

    public function setCodigoUnidad($param) {


        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionOnlyLetter($param)) {
            $this->codigo_unidad = $param;
        } else {
            echo('<script>alert("Escriba un codigo de unidad valido ")</script>');
            raiz();
        }
    }

    public function setNombreUnidad($param) {


        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionOnlyLetter($param)) {
            $this->nombre_unidad = $param;
        } else {
            echo('<script>alert("Escriba un codigo de unidad valido ")</script>');
            raiz();
        }
    }

    public function setNombreExt($param) {


        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionOnlyLetter($param)) {
            $this->nombre_ext = $param;
        } else {
            echo('<script>alert("Escriba un valor alfavetico para el campo nombre Extruder ")</script>');
           raiz();
        }
    }

    public function setNombreProductoAjax($param) {

        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExNRP($param)) {
            $this->nombreProducto = $param;

            return true;
        } else {
            return false;
        }
    }

    public function setCodigoProductoAjax($param) {

        $param = $this->desinfeccionDeVariables($param);
        if ($this->GetObjetoExrg()->functionOnlyLetter($param)) {
            $this->codigoProducto = $param;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion que establece el codigo,
     * para un producto en proceso
     * @param int $param
     * @return boolean
     */
    public function setCodigoProductoProcesoAjax($param) {



        if ($this->CompruebaNumero($param)) {
            $this->codigoProductoProceso = $param;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigoProductoProceso($param) {

        if ($this->setCodigoProductoProcesoAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  sin espacios para codigo de producto en proceso")</script>');
            raiz();
            exit();
        }
    }

    /*     * *************************** */

    public function setCodigoTipoLaminaAjax($param) {

        if ($this->CompruebaNumero($param)) {

            $consulta = $this->CompruebaTipoLamina($param);


            if (($consulta->num_rows) >= 1) {

                $this->codigoLamina = $param;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCodiTipoLamina() {
        return $this->codigoLamina;
    }

    public function setCodigoTipoLamina($param) {

        if ($this->setCodigoTipoLaminaAjax($param)) {
            
        } else {
            echo('<script>alert("El codigo de lamina intruducido no existe")</script>');
            raiz();
            exit();
        }
    }

    /*     * ************************** */

    public function setCantidadMinimaAjax($param) {

        if (!$this->CompruebaNumero($param)) {
            return false;
        } else {
            return true;
        }
    }

    public function setPesoProductoAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {
            if ($param > 0) {
                $this->peso_ficha = $param;
                return true;
            }
        } else {
            return false;
        }
    }

    public function getPesoProducto() {
        return $this->peso_ficha;
    }

    public function getEspesor() {
        return $this->espesor;
    }

    public function setEspesorAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {

            if ($param > 0) {
                $this->espesor = $param;
                return true;
            }
        }

        return false;
    }

    public function setEspesor($param) {

        if ($this->setEspesorAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  sin espacios para el campo Espesor")</script>');
            raiz();
            exit();
        }
    }

    public function setLargoAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {

            if ($param > 0) {
                $this->largo = $param;
                return true;
            }
        }

        return false;
    }

    public function setLargo($param) {

        if ($this->setLargoAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  mayor que cero sin espacios para el campo Largo")</script>');
           raiz();
            exit();
        }
    }

    public function getLargo() {
        return $this->largo;
    }

    public function setAnchoAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {

            if ($param > 0) {
                $this->ancho = $param;
                return true;
            }
        }

        return false;
    }

    public function setAncho($param) {

        if ($this->setAnchoAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  mayor que cero sin espacios para el campo Ancho")</script>');
            raiz();
            exit();
        }
    }

    public function getAncho() {
        return $this->ancho;
    }

    /**
     * 
     * @param type $param
     * @return boolean
     */
    public function setTratamientoAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {
            $this->tratamiento = $param;
            return true;
        } else {
            return false;
        }
    }

    public function setTratamiento($param) {

        if ($this->setTratamientoAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  sin espacios para el campo Tratamiento")</script>');
            raiz();
            exit();
        }
    }

    public function getTratamiento() {
        return $this->tratamiento;
    }

    public function setCodigoFormula($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {
            $this->codigo_formula = $param;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * Funcion que valida el valor para un producto en proceso
     * que se intenta registrar en una ficha tecnica
     * @param int $param
     * @return boolean
     */
    public function setPesoProductoProcesoAjax($param) {

        if ($this->GetObjetoExrg()->functionOnlyNumberDecimal($param)) {
            if ($param > 0) {
                $this->pesoProdcuto = $param;
                return true;
            }
        }

        return false;
    }

    public function setPesoProductoProceso($param) {

        if ($this->setPesoProductoProcesoAjax($param)) {
            
        } else {
            echo('<script>alert("Escriba un valor numerico  sin espacios para el campo Peso")</script>');
            raiz();
        }
    }

    public function setCantidadMinima($param) {

        if (!$this->CompruebaNumero($param)) {
            echo('<script>alert("Escriba un valor numerico  sin espacios para el campo Cantidad Minima")</script>');
            raiz();
        } else {
            $this->cantidadMinima = $param;
        }
    }

    /**
     * recupera el valor del id de una Ficha
     * @return type 
     */
    public function getFicha() {
        return $this->idFicha;
    }

    /**
     * funcion que establece un valor para el atributo $nombreProducto
     * del objeto cliente
     * @param type $param 
     */
    public function setNombreProducto($param) {

        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExNRP($param)) {
            $this->nombreProducto = $param;
        } else {
            echo('<script>alert("Escriba un nombre de producto valido ")</script>');
            raiz();
        }
    }

    /**
     * funcion que establece un valor para el atributo nit
     * del objeto cliente
     * @param type $param 
     */
    public function setNit($param) {

        if ($this->cliente->setNit($param)) {
            
        } else {
            echo('<script>alert(" NIT ERRADO  \npor favor ingrese un formato de nit como el de este ejemplo\n800.800.800-X\n donde X es un digito")</script>');
            raiz();
        }
    }

    public function getNit() {
        return $this->cliente->getNit();
    }

    /**
     * funcion que establece un valor para el atributo $tipoProducto
     * del objeto cliente
     * @param type $param 
     */
    function tratarTP($tipoProducto) {


        $bool = $this->ConsultaTipoProducto($tipoProducto);
        $this->next_result();
        $filas = $bool->num_rows;

        if ($filas > 0) {

            $this->tipoProducto = $tipoProducto;

            return true;
        } else {
            echo('<script>alert("El tipo de producto seleccionado no existe")</script>');
            return false;
        }
    }

    function setUnidadMedida($param) {

        $bool = $this->ConsultaTipoUnidadMedida($param);
        $this->next_result();
        $filas = $bool->num_rows;

        if ($filas > 0) {

            $this->unidadeDeMedida = $param;

            return true;
        } else {
            echo('<script>alert("El tipo de unidad seleccionado no existe")</script>');
            return false;
        }
    }

    /**
     * funcion que establece un valor para el atributo $refProducto
     * del objeto cliente
     * @param type $param 
     */
    public function setRefProducto($param) {

        $param = $this->desinfeccionDeVariables($param);

        if ($this->GetObjetoExrg()->functionExNRP($param)) {

            $this->refProducto = $param;
        } else {
            echo('<script>alert("Escriba un nombre de ref valido ")</script>');
            raiz();
            return false;
        }
        return true;
    }

    public function getIdFicha() {

        return $this->idFicha;
    }

    /**
     *
     * @param type $param 
     */
    public function getNombreCliente() {
        return $this->cliente->getRs();
    }

    /**
     *
     * @param type $param 
     */
    public function getNombreProducto() {

        return $this->nombreProducto;
    }

    /**
     *
     * @param type $param 
     */
    public function getRefProducto() {

        return $this->refProducto;
    }

    public function getTipoProducto() {

        return $this->tipoProducto;
    }

    /**
     * Funcion que permite el  registro de un 
     * articulo/producto en la bd
     * @param type $param 
     */
    public function functionIngrearProducto($param) {

        $consulta = $this->CompruebaDuplicado();
        $this->next_result();

        if (($consulta->num_rows) <= 0) {


            $this->procesaTransacciones($param);
        } else {
            echo('<script>alert("Ya existe un prodcuto registrados con estos datos ")</script>');
            raiz();
        }
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * @param type $param representa el codigo de  una ficha tecnica
     * @return type 
     */
    public function consultaCantidadFicha($param) {

        return $this->query("CALL Ficha_ConsultaCantidadMinimaPorProducto('$param')");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * @param type $param
     * @return type 
     */
    public function crearListaDesplegable() {

        return $this->query("CALL Ficha_Lista_Desplegable_TipoProductoProceso('$this->id') ");
    }
    
    
    public function cargarListadoArticulo(){
        
         $consulta = $this->crearListaDesplegable();
        
        $num_total_registros = $consulta->num_rows;
        if ($num_total_registros > 0) {
            $maquina = array();
            while ($pais = $consulta->fetch_array(MYSQLI_ASSOC)) {
                $code = $pais["Id_tipoProducto"];
                $name = $pais["nombreProducto"];
                $maquina[$code] = $name;
            }
            return $maquina;
        } else {
            return false;
        }
    }



    public function cargarListadoUnidades(){
        
         $consulta = $this->crearListaDesplegableUnidadDeMedida();


        
        $num_total_registros = $consulta->num_rows;


        if ($num_total_registros > 0) {
            $maquina = array();
            while ($pais = $consulta->fetch_array(MYSQLI_ASSOC)) {
                $code = $pais["id_unidad"];
                $name = $pais["nombre_unidad"];
                $maquina[$code] = $name;
            }


            return $maquina;
        } else {
            return false;
        }
    }
    

    public function listaDesplegableTipoProductoProce() {
        return $this->query("CALL Ficha_Lista_Desplegable_ProductoProceso()");
    }

    public function actulizarFormulaProductoEnFicha() {
        return $this->query("CALL Ficha_Actualizar_formula_producto_en_ficha($this->codigo_formula,'$this->idFicha',$this->codigoProductoProceso);");
    }

    public function listaDesplegableTipoLamina() {
        return $this->query("call Ficha_listaDesplegableTipoLamina()");
    }

    public function actualizarFechaUltimaModificacion() {
        return $this->query("CALL Ficha_actualizarFechaUltimadeModificacion('$this->idFicha')");
    }

    /**
     * Funcion realiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli.
     * se ustiliza en el modulo del sistema para consultar
     * los tipos de articulos registrados en la aplicacion
     * @param type $param
     * @return type 
     */
    public function crearListaDesplegableUnidadDeMedida() {
        return $this->query("CALL Ficha_listaDesplegableTipoUnidades('$this->id')");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * se utiliza en el modulo del sistema para consultar
     * los tipos de extruder registrados en la aplicacion
     * @param type $param
     * @return type 
     */
    public function crearListaDesplegableExt() {
        return $this->query("CALL Ficha_ListaDesplegable_Extruders()");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * @param type $param
     * @return type 
     */
    public function mostrarDatosFicha($param) {

        return $this->query("CALL Ficha_mostrar_datos_ficha('$param',$this->id)");
        
    }

    public function mostrarDatosEncabezadoFicha($param) {

        return $this->query("CALL Ficha_Mostrar_Datos_Encabezado('$param')");
    }

    /**
     * 
     * @param type $param representa el codigo de ficha a buscar
     * @param type $nit representa el nit del cliente
     * @return type resulset objeto de MySqli
     */
    public function buscarFichaPorId($param, $nit) {

        return $this->query("CALL Ficha_mostrarDatoFicha('$param','$nit')");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * se utiliza para consultar los datos de una ficha,
     * registrada en la aplicacion
     * @param type $param
     * @return type 
     */
    public function buscarFicha($nit, $ficha, $nombreProducto, $refProducto, $tipoProducto) {

    return $this->query(" CALL Ficha_ConsultarFicha('$nit','$ficha','$nombreProducto','$refProducto','$tipoProducto','$this->id');"); 
    }

    /**
     *  
     * @param type $nit
     * @param type $ficha
     * @param type $nombreProducto
     * @param type $refProducto
     * @param type $tipoProducto
     * @param type $limit
     * @return type
     * 
     * funcion que consulta por grupos de datos utilizando la funcion limit
     */
    public function buscarFichaPaginada($nit, $ficha, $nombreProducto, $refProducto, $tipoProducto, $limit) {
        return $this->query("CALL Ficha_BuscarFichaPAginada ('$nit','$ficha','$nombreProducto','$refProducto','$tipoProducto','$limit','$this->id')");
    }

    public function contarFichaTecnicasRegistradas($nit, $ficha, $nombreProducto, $refProducto, $tipoProducto) {

        return $this->query("CALL Ficha_contar_fichaTecnica ('$nit','$ficha','$nombreProducto','$refProducto','$tipoProducto','$this->id')"); 


        
        $this->comprobarPriviligios($resultado);
        
        return $resultado;
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * se utiliza en
     * @param type $param
     * @return type 
     */
    public function ConsultaTipoProductoPorParametros($codigo_producto, $nomP = "", $canMin = "", $selectP = "") {

        return $this->query("CALL Ficha_consultarTipoArticulo('$codigo_producto','$nomP','$canMin','$selectP','$this->id');");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * @param type $param
     * @return type 
     */
    public function CompruebaDuplicado() {

        $this->nit = $this->cliente->getNit();
        return $this->query("CALL Ficha_comprobar_insumo_duplicado ('$this->nombreProducto','$this->refProducto','$this->nit','$this->tipoProducto')");
    }

    /**
     * Funcion que comprueba si la ficha tecnica 
     * esta completa.
     * @return resulset Mysqli
     */
    public function CompruebaFichaTerminadaAjax() {

        $resultado = $this->query("CALL Ficha_comprobar_ficha_Completa('$this->idFicha')");
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        $countFicha = $row['no_fichas'];
        if ($countFicha >= 4) {
            return true;
        }

        return false;
    }

    public function CompruebaTipoLamina($param) {


        return $this->query("CALL Ficha_Consulta_TipoPelicula('$param')");
    }

    public function CompruebaProductoDuplicadoEnFicha() {
        $this->codigo_formula = $this->formula->getFormula();
        return $this->query(" CALL Ficha_Comprueba_producto_duplicado_en_ficha($this->codigoProductoProceso,'$this->idFicha')");
    }

    /**
     * verifica si realmente el codigo de ficha tecnica existe
     * @return type
     */
    public function CompruebaFichaRelacionProducto() {

        return $this->query("CALL Ficha_CompruebaRelacionFichaProducto('$this->idFicha')");
    }

    public function regirarFicha() {

        return $this->query("CALL Ficha_registrar_Ficha('$this->idFicha','$this->peso_ficha')");
    }

    /**
     * 
     * funcion que permite registrar los productos
     * en proceso con que se compone una ficha
     * tecnica, como valvulas ref, pelicula principal etc.
     * @return resulset
     */
    public function regirarProductoProcesoEnFicha() {

        $codigo_formula = $this->formula->getFormula();
        return $this->query("CALL Ficha_Agregar_ProductoProceso($this->codigoProductoProceso,'$this->idFicha',$codigo_formula,$this->tratamiento,$this->ancho,$this->largo,$this->espesor,$this->pesoProdcuto,$this->codigoLamina);");
    }

    public function consultaFichaRegsitrada() {

        return $this->query("CALL Ficha_Mostrar_ficharegistrada('$this->idFicha')");
    }

    public function consultaEncabezadoFichaRegsitrada($id_ficha) {

        return $this->query("CALL Ficha_consultar_encabezado('$id_ficha')");
    }

    public function consultaEncabezadoFichaRegsitradaPaginado($id_ficha, $limite) {

        return $this->query("CALL FichaConsultaEncabezadoPaginado('$id_ficha','$limite')");
    }

    public function contarEncabezadoFichaRegistrada($id_ficha) {

        return $this->query("CALL Ficha_contarEncabezado('$id_ficha')");
    }

    public function CompruebaIdFicha() {


        return $this->query("CALL Ficha_ConsultarDuplicado('$this->idFicha')");
    }

    public function CompruebaDuplicadoTipoProducto() {

        return $this->query("CALL Ficha_ConsultaCodigoTipoArticulo('$this->codigoProducto','$this->id')  ");
    }

    /**
     * funcion que consulta si existe un nombre de producto
     * registrado en la base de datos.
     * @return type
     */
    public function CompruebaDuplicadoNombreProducto() {

        return $this->query(" CALL Ficha_ConsultaNombreProducto('$this->nombreProducto')");
    }

    /**
     *  funcion que consulta si existe una unidade de medida
     * comprobando los parametros de codigo unidad
     * y nombre unidad
     * @return type
     */
    public function CompruebaDuplicadoUnidadddMedida() {

        return $this->query(" CALL Ficha_consultaUnidadDeMedida('$this->codigo_unidad','$this->nombre_unidad','$this->id');");
    }

    public function CompruebaDuplicadoNombreExtruder() {

        return $this->query(" call Ficha_consultaExtPorNombre('$this->nombre_ext')");
    }

    public function ConsultaTipoProducto($param) {

        return $this->query("CALL Ficha_conprobar_Tipo_de_producto('$param','$this->id')");
    }

    public function ConsultaTipoUnidadMedida($param) {

        return $this->query("call Ficha_consultar_unidad_medida('$param')");
    }

    /**
     * Funcion que permite verificar la existencia
     * de un extruder en la bd consultandolo por medio
     * de su nombre
     * @param type $param nombre del extruder
     * @return type
     */
    public function ConsultaExtruderPorNombre($param) {
        return $this->query("CALL Ficha_consultaExtPorNombre('$param')  ");
    }

    /**
     * Funcion que arma una cadena sql  valida para ser 
     * utilizada en una consulta
     * 
     * devuelve una cadena
     * @param type $param
     * @return type 
     */
    public function consultaregistrarProducto($id_empresa) {
        $this->nit = $this->cliente->getNit();
        return("CALL Ficha_registrar_producto_final('$this->idFicha','$this->nombreProducto','$this->refProducto','$this->nit','$this->tipoProducto','$this->id');");


    }

    /**
     * Funcion que arma una cadena sql  valida para ser 
     * utilizada en una consulta para registrar
     * un tipo de producto en la aplicacion
     * 
     * devuelve una cadena
     * @param type $param
     * @return type 
     */
    public function consultaRegistrarTipoProducto() {


        return $this->consulta = " CALL Ficha_registrarTipoArticulo('$this->codigoProducto','$this->nombreProducto','$this->cantidadMinima','$this->unidadeDeMedida','$this->id')";

    }

    /**
     * Funcion que arma una cadena sql  valida para ser 
     * utilizada en una consulta, para registrar un 
     * tipo de unidad en la aplicacion
     * 
     * devuelve una cadena
     * @param type $param
     * @return type 
     */
    public function consultaRegistrarTipoUnidad() {

        return $this->consulta = "CALL Ficha_registrarCodigoUnidad('$this->codigo_unidad','$this->nombre_unidad','$this->id')";
        

    }

    /**
     * Funcion que arma una cadena sql  valida para ser 
     * utilizada en una consulta para registrar un extruder
     * en la aplicacion.
     * 
     * devuelve una cadena
     * @param type $param
     * @return type 
     */
    public function consultaRegistrarExt() {
        return $this->consulta = " CALL Ficha_registrarExt('$this->nombre_ext')";
    }

    public function ActualizarCantidadTipoProducto($cantidad, $codigo) {


        return $this->query("CALL Ficha_ActualizarCantidadTipoProducto('$cantidad','$codigo')");
    }

    /**
     * Funcion relaiza una peticion al servidor de BD
     * y devuelve un Objeto Mysqli
     * cuenta cuantas fichas existen para luego asignar un consecutivo
     * @param type $param
     * @return type 
     */
    public function consultaNoREgistro($param) {

       return ("CALL Ficha_contar_numero_de_producto('$param',$this->id)");


    }

    public function consultaNitAtravezdeCodigoFicha($param) {

        return $this->query("CALL Ficha_consulta_nit_cliente('$param')");
    }

    /**
     * esta funcion se utiliza cuando el usuario refrezca la
     * pagina,  y se ejecuta nuevamente el script,
     * como cada vez que se ejecuta el script se crea un consecutivo
     * nuevo para una ficha , al tratar de buscar esa ficha no existira
     * en la bd, dado que no se registra por se duplicada, y por ende no 
     * se vizualiza en la pantalla del usuario, pero esto genera una insertidumbre
     * de la aplicacion dado que al actualizar dezaparecen los datos
     * esta funcion se encarga de mantener los datos antiguos en pantalla. no
     * importa que se actulize la pagian cuantas veces sea necesario
     * @param type $param
     * @param type $No
     * @return type 
     */
    public function getIdFichaAnterior($param, $No) {

        /**
         * siempre aumentamos en uno el id de la ficha 
         */
        $param = $this->desinfeccionDeVariables($param);
        $No = $this->desinfeccionDeVariables($No);

        $param = $param . $No;

        if ($this->GetObjetoExrg()->functionNumAndLet($param)) {


            $this->idFicha = $param;

            return $this->idFicha;
        } else {
            
        }
    }

    public function getObjetoCliente() {

        return $this->cliente;
    }

}
?>

<?php

/*
  @session_start();
  $_SESSION['k_userName'] = 'amd';
  $_SESSION['k_userPass'] = '12345678';
  $p = new FichaTecnica();

  echo memory_get_usage() / 1024 . "\n"; */
?>
