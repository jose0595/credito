<?php 
class conectar{
     public function conexion(){
     	try {
     		$conexion=mysqli_connect('localhost','mavasaco_credito','mavasacredito','mavasaco_creditos');
     	} catch (mysqli_sql_exception $e) {
     		$conexion=null;
     	}
        
        return $conexion;
    }
}
?> 