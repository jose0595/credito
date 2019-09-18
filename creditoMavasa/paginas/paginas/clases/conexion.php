<?php 
class conectar{
    public function conexion(){
        $conexion=mysqli_connect('localhost','mavasaco_credito','mavasacredito','mavasaco_creditos');
        return $conexion;
    }
}
?> 