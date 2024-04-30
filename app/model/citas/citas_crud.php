<?php
require_once ('../model/vinculo.php');
class Citas_crud
{
    public function agendarCita($cita)
    {

        $db = Conectar::acceso();
        $update = $db->prepare('UPDATE citas SET afiliado=:afiliado, estado_cita=:estado_cita WHERE codigo_cita=:id AND estado_cita=:estado');
        $update->bindValue('estado_cita',2);
        $update->bindValue('id', $cita->getCodigoCita());
        $update->bindValue('afiliado', $cita->getAfiliado());
        $update->bindValue('estado', 1);
        $update->execute();
        
        $numFilasActualizadas = $update->rowCount();
        echo $numFilasActualizadas > 0 ? 1 : 0;
    }

    public function consultarCitasSinAgendar($data)
    {

        $db = Conectar::acceso();
        $consultAll = $db->prepare('SELECT * FROM citas WHERE fecha_cita=:fecha AND especialidad_cita=:especialidad AND estado_cita=:estado');
        $consultAll->bindValue('estado', 1);
        $consultAll->bindValue('fecha', $data->getFechaCita());
        $consultAll->bindValue('especialidad', $data->getEspecialidadCita());
        $consultAll->execute();

        $results = $consultAll->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($results);

    }

    public function consultarCitasPorUsuario($afiliado)
    {

        $db = Conectar::acceso();
        $consult = $db->prepare('SELECT * FROM citas WHERE afiliado=:afiliado AND estado_cita=:estado');
        $consult->bindValue('estado', 2);
        $consult->bindValue('afiliado', $afiliado->getAfiliado());
        $consult->execute();

        $results = $consult->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($results);

    }

    public function cancelarCita($cita){
        $db = Conectar::acceso();
        $update = $db->prepare('UPDATE citas SET afiliado=:afiliado, estado_cita=:estado_cita WHERE codigo_cita=:id AND estado_cita=:estado');
        $update->bindValue('estado_cita',1);
        $update->bindValue('id', $cita->getCodigoCita());
        $update->bindValue('afiliado', null);
        $update->bindValue('estado', 2);
        $update->execute();
        
        $numFilasActualizadas = $update->rowCount();
        echo $numFilasActualizadas > 0 ? 1 : 0;
    }
}
?>