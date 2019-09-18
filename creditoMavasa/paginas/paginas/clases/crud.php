<?php

 class crud{
		public function agregar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="INSERT into usuarios (nombre,password,nivel_usuario)
									values ('$datos[0]',
											'$datos[1]',
											'$datos[2]')";
			return mysqli_query($conexion,$sql);
		}

     public function agregarCliente($datosC){
         $obj = new conectar();
         $conexion= $obj->conexion();

         $sql= "INSERT into clientes (rfc, razon_social, nombre, apellidos, direccion, telefono, id_ciudad, id_estado, id_categoria) values('$datosC[0]','$datosC[1]','$datosC[2]','$datosC[3]','$datosC[4]','$datosC[5]','$datosC[6]','$datosC[7]','$datosC[8]')";

         return mysqli_query($conexion,$sql);
     }
     
     public function agregarCiudad($datos){
     	$obj = new conectar();
         $conexion= $obj->conexion();

         $sql= "INSERT into ciudades (ciudad) values('$datos[0]')";

         return mysqli_query($conexion,$sql);
     }

     public function agregarEstado($datos){
     	$obj = new conectar();
         $conexion= $obj->conexion();

         $sql= "INSERT into estados (estado) values('$datos[0]')";

         return mysqli_query($conexion,$sql);
     }

      public function agregarCredito($datosCr){
         $obj = new conectar();
         $conexion= $obj->conexion();
         $idcredito= self::creaFolio();

         $sql= "INSERT into credito (id_credito, cantidadsolicitada, fechasolicitud, id_status, cantidadaprobada, fechaaprobado, id_cliente, id_usuario) values('$idcredito','$datosCr[0]','$datosCr[1]','$datosCr[2]','$datosCr[3]','$datosCr[4]','$datosCr[5]','$datosCr[6]')";
         
          return mysqli_query($conexion,$sql);

     }

     public function creaFolio(){
        $obj= new conectar();
        $conexion=$obj->conexion();

        $sql="SELECT id_credito from credito group by id_credito desc";

        $resul=mysqli_query($conexion,$sql);
        $id=mysqli_fetch_row($resul)[0];

        if($id=="" or $id==null or $id==0){
            return 1;
        }else{
            return $id + 1;
        }
    }

		public function obtenDatos($idusuario){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT *
					from usuarios
					where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'id_usuario' => $ver[0],
				'nombre' => $ver[1],
				'password' => $ver[2],
				'nivel_usuario' => $ver[3]
				);
			return $datos;
		}

     	public function obtenDatosC($idcliente){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT clientes.id_cliente, clientes.rfc, clientes.razon_social, clientes.nombre, clientes.apellidos, clientes.direccion, clientes.telefono, clientes.id_ciudad, clientes.id_estado, clientes.id_categoria from clientes where id_cliente='$idcliente'";
			 $result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datosC=array(
				'id_cliente' => $ver[0],
				'rfc' => $ver[1],
				'razon_social' => $ver[2],
				'nombre' => $ver[3],
                'apellidos' => $ver[4],
                'direccion' => $ver[5],
                'telefono' => $ver[6],
                'ciudad' => $ver[7],
                'estado' => $ver[8],
                'categoria' => $ver[9]
				);
			return $datosC;
		}

     	public function obtenDatosCr($id_credito){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="select credito.id_credito, clientes.RFC, credito.cantidadsolicitada,  credito.fechasolicitud, estado_credito.estatus, credito.cantidadaprobada, credito.fechaaprobado from clientes inner join credito on credito.id_cliente = clientes.id_cliente inner join estado_credito on credito.id_status = estado_credito.id_status where credito.id_credito='$id_credito'";

            $result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);


            $datosCr=array(
				'id_credito' => $ver[0],
				'rfc' => $ver[1],
				'cantidad' => $ver[2],
                'fecha' => $ver[3],
                'estatus' => $ver[4]
				);

            return $datosCr;
		}

		public function actualizar($datos){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="UPDATE usuarios set nombre='$datos[0]',
				                password='$datos[1]',
								nivel_usuario='$datos[2]'
						where id_usuario='$datos[3]'";
			return mysqli_query($conexion,$sql);
		}
     	public function actualizarC($datosC){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="UPDATE clientes set rfc='$datosC[0]',
				                razon_social='$datosC[1]',
								nombre='$datosC[2]',
                                apellidos='$datosC[3]',
                                direccion='$datosC[4]',
                                telefono='$datosC[5]',
                                id_ciudad='$datosC[6]',
                            id_estado='$datosC[7]',
                                id_categoria='$datosC[8]'
						where id_cliente='$datosC[9]'";
			return mysqli_query($conexion,$sql);
		}
     	public function actualizarCr($datosCr){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="UPDATE credito set cantidadsolicitada='$datosCr[0]',
				            fechasolicitud='$datosCr[1]',
                            id_status='$datosCr[2]',
                             cantidadaprobada='$datosCr[3]',
                            fechaaprobado='$datosCr[4]',
                            id_usuario='$datosCr[5]'
						where id_credito='$datosCr[6]'";

            return mysqli_query($conexion,$sql);
		}
		public function eliminar($idusuario){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="DELETE from usuarios where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
     public function eliminarC($idcliente){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="DELETE from clientes where id_cliente='$idcliente'";
			return mysqli_query($conexion,$sql);
		}
     public function eliminarCr($idcredito){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="DELETE from credito where id_credito='$idcredito'";
			return mysqli_query($conexion,$sql);
		}
	}


?>
