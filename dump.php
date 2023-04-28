<?php
require "connect.php";
$dumpQuery = "SELECT participantes.idParticipante, nombre, apellidos,escuela, ticket, correo FROM participantes INNER JOIN confirmacion_datos ON participantes.idParticipante = confirmacion_datos.idParticipante";
$dumpQuery = $connection->query($dumpQuery);
echo "NOMBRE, ESCUELA, CORREO, CAMPUS, SEMESTRE, TICKET, ASEGURADORA, POLIZA, CARRERA, CONTACTO, EQUIPO<br>";
while($row = $dumpQuery->fetch_assoc())
{
    echo $row["idParticipante"].",".$row["nombre"]." ".$row["apellidos"].",".$row["escuela"].",".$row["correo"];
    $query = "SELECT campus FROM participantes_tec WHERE idParticipante = '".$row["idParticipante"]."'";
    $query=$connection->query($query);
    if($query->num_rows == 1)
    {
   
        $rowC = $query->fetch_assoc();
        echo ",".$rowC["campus"].",".$rowC["semestre"];
        
    }else
    {
        echo ",,";
    }
    echo ",".$row["ticket"];
    $query2 = "SELECT * FROM carta_responsabilidad WHERE idParticipante = '".$row["idParticipante"]."'";
    $query2=$connection->query($query2);
    if($query2->num_rows == 1)
    {
        
        $rowC = $query2->fetch_assoc();
        echo ",".$rowC["nombre_aseguradora"].",".$rowC["numero_poliza_seguro"].", ".$rowC["carrera"].", ".$rowC["contacto_emergencia"];
        
    }else
    {
        echo ",,,,";
    }
    $query3 = "SELECT * FROM equipos_hackmx INNER JOIN miembros_equipo USING(idEquipo) WHERE idParticipante = '".$row["idParticipante"]."'";
    $query3=$connection->query($query3);
    if($query3->num_rows == 1)
    {
        
        $rowC = $query3->fetch_assoc();
        echo ",".$rowC["nombre_equipo"]."<br>";
        
    }else
    {
        echo ",<br>";
    }
}
?>
