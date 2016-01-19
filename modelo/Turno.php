<?php



class Turno extends Database {

    private $turno;

    const TURNO_A = 1;
    const TURNO_B = 2;
    const TURNO_C = 3;
    private $listaDesplegable;

    public function __construct() {
        parent::__construct();
          $this->listaDesplegable = new GenerarListaDesplegable();
    }

    public function setIdEmpresa($param) {
        parent::setIdEmpresa($param);
    }

    public function getTurno() {
        return $this->turno;
    }

    public function setTurno() {
        $horaActual = time();

        if ($this->isTurnoA($horaActual)) {
            $this->turno = self::TURNO_A;
            return;
        }

        if ($this->isTurnoB($horaActual)) {
            $this->turno = self::TURNO_B;
            return;
        }

        if ($this->isTurnoC($horaActual)) {
            $this->turno = self::TURNO_C;
            return;
        }
    }

    private function isTurnoA($horaActual) {

        $objetoHora = $this->consultaHoraTurno(self::TURNO_A);
        $horaInicioTurno = strtotime($objetoHora->inicio_turno);
        $horaFinTurno = strtotime($objetoHora->fin_turno);

        $this->next_result();
        return ($horaActual > $horaInicioTurno && $horaActual < $horaFinTurno);
    }

    private function consultaHoraTurno($turno) {
        $consulta = $this->query("CALL ConsultaHoraTurno('$this->id','$turno');");
        return $consulta->fetch_object();
    }

    private function isTurnoB($horaActual) {

        $objetoHora = $this->consultaHoraTurno(self::TURNO_B);
        $horaInicioTurno = strtotime($objetoHora->inicio_turno);
        $horaFinTurno = strtotime($objetoHora->fin_turno);

        $this->next_result();
        return ($horaActual > $horaInicioTurno && $horaActual < $horaFinTurno);
    }

    private function isTurnoC($horaActual) {

        $objetoHora = $this->consultaHoraTurno(self::TURNO_C);
        $horaInicioTurno = strtotime($objetoHora->inicio_turno);
        $horaFinTurno = strtotime($objetoHora->fin_turno);



        $this->next_result();
        return ($horaActual > $horaInicioTurno || $horaActual < $horaFinTurno);
    }

    public function getListadoDeTurno() {
        $consulta = $this->consultarTurnoRegistrados();
        return $this->listaDesplegable->generarListadoDesplegable($consulta, 'id', 'descripcion');
    }

    private function consultarTurnoRegistrados() {

        return $this->query("CALL ListadoTurno('$this->id')");
    }
    
    public function setIdTurnoManual($idTurno) {
         $this->turno=(int)$idTurno;
    }

    public function getNombreTurno(){
        return $this->nombreTurno;
    }
    
    public function setNombreTurno($nombre){
        $this->nombreTurno=$nombre;
    }

    public function consultaIdTurno(){        
        return $this->query("CALL getIdTurno('$this->id','$this->nombreTurno')");       
       
    }
    
    
    public function getIdTurno(){
        
        $consulta = $this->consultaIdTurno();
        $row = $consulta->fetch_array(MYSQLI_ASSOC);
        $idTurno = $row['id'];
        return $idTurno;
    }

}

?>
