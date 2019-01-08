<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
	}
	private function validar_parametros_crear($nombre, $id_usuario){
		if (!empty($nombre) && !empty($id_usuario) && $id_usuario>0) {
			return 1;
			#es 1 cuando el nombre, id_usuario no son vacio y el id_usuario es >0
		} else {
			return 0;
			#es 0 cuando el nombre o id_usuario es vacio o el id_usuario no es >0
		}
	}
	private function validar_parametros_agregar($id_playlist){
		if (!empty($id_playlist) && $id_playlist>0) {
			return 1;
		} else {
			return 0;
		}
	}
	private function checar_codigo($estado){
		if ($estado['codigo'] == 201) {
			return 1;
			#es 1 cuando se creo la playlist con exito
		} elseif ($estado['codigo'] == 200) {
			return 2;
		} else {
			return 0;
			#es 0 cuando ocurrio algun problema al crear la playlist
		}
	}
	public function index(){
		/*$this->load->view('musica_web/usuario/header');
		$this->load->view('musica_web/usuario/principal', compact("usuario"));
		$this->load->view('musica_web/usuario/footer');*/
    
	}
	public function playlists(){
		$usuario = $this->input->post();
		$vista_playlist = $this->load->view('musica_web/usuario/playlists_2', compact("usuario"));
        return $vista_playlist;
	}
	/*public function playlists_2(){
		$usuario = $this->input->post();
		$vista_playlist = $this->load->view('musica_web/usuario/playlists_2', compact("usuario"));
        return $vista_playlist;
	}*/
	public function principal(){
		$usuario = $this->input->post();
		$vista_inicio = $this->load->view('musica_web/usuario/principal', compact("usuario"));
        return $vista_inicio;
	}
	public function agregar_playlist(){
		$parametros = $this->input->post();
		//print_r($parametros);
		if($this->validar_parametros_crear($parametros['nombre'], $parametros['id']) == 1){
			//echo '<script>alert("Los campos son validos");</script>';
			$parametros['id'] = (int)$parametros['id'];
			header('Content-Type: application/json');
			echo json_encode($parametros, JSON_FORCE_OBJECT);
		}else{
			echo 0;
		}
	}
	public function mostrar_playlist(){
		$respuesta = $this->input->post();
		$usuario = $respuesta['usuario'];
		$api = $respuesta['respuesta'];
		if ($this->checar_codigo($api) == 1) {
			if (isset($usuario['playlists'])) {
				array_push($usuario['playlists'], $api['data']);
				$aviso = ". Regresa a la pagina principal para ver la playlist creada";
				echo '<script>alert("'.$api['mensaje'].$aviso.'");</script>';
				$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
				return $vista_principal;
			} else {
				$aux['playlists'] = [];
				array_push($aux['playlists'], $api['data']);
				$usuario['playlists'] = $aux['playlists'];
				$aviso = ". Regresa a la pagina principal para ver la playlist creada";
				echo '<script>alert("'.$api['mensaje'].'");</script>';
				$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
				return $vista_principal;
			}
		} else {
			echo '<script>alert("'.$api['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
			return $vista_principal;
		}
	}
	function canciones_disponibles(){
		$respuesta = $this->input->post();
		$usuario = $respuesta['usuario'];

		$canciones = file_get_contents("https://apimusica.000webhostapp.com/testServer/index.php/api/Canciones/canciones");

		if (!$canciones) {
			//$usuario = $respuesta['usuario'];
			echo '<script>alert("Error al conectar con la api");</script>';
			$vista_principal = $this->load->view('musica_web/usuario/principal', compact("usuario"));
			return $vista_principal;
		}else{
			$estado = json_decode($canciones, true);
			if ($this->checar_codigo($estado) == 2) {
			#exito con la conexion a la api
				$usuario['id_playlist'] = $respuesta['id_playlist'];
				$usuario['canciones'] = $estado['data'];
				$vista_canciones=$this->load->view('musica_web/usuario/canciones_disponibles', compact("usuario"));
        		return $vista_canciones;
			}else{
				#error al consultar la informacion a la api
				//$usuario = $respuesta['usuario'];
				echo '<script>alert("'.$estado['mensaje'].'");</script>';
				$vista_principal = $this->load->view('musica_web/usuario/principal', compact("usuario"));
				return $vista_principal;
			}
		}
	}
	function validar_canciones(){
		$respuesta = $this->input->post();
		$usuario = $respuesta['usuario'];
		$usuario['id_playlist'] = (int)$respuesta['id_playlist'];
		$usuario['id_cancion'] = $respuesta['id_cancion'];
		foreach ($usuario['id_cancion'] as $id) {
			$id = (int)$id;
		}
		if ($this->validar_parametros_agregar($usuario['id_playlist']) == 1) {
			header('Content-Type: application/json');
			echo json_encode($usuario, JSON_FORCE_OBJECT);
		} else {
			echo 0;
		}
	}
	function actualizar_canciones(){
		$respuesta = $this->input->post();
		$usuario = $respuesta['usuario'];
		$api = $respuesta['respuesta'];
		$contra = $usuario['contrasenia'];
		if ($this->checar_codigo($api) == 1) {
			#exito al agregar las canciones
			$aviso = ". Regresa a la pagina principal para ver las canciones agregadas";
			echo '<script>alert("'.$api['mensaje'].$aviso.'");</script>';
			$nombre = str_replace(" ","%20",$usuario['nombre']);
			$info = file_get_contents("https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios?nombre=".$nombre."&contrasenia=".$contra);
			#actualizo la info del usuario

			if (!$info) {
				echo '<script>alert("error al actualizar las playlists");</script>';
				$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
				return $vista_principal;
			} else {
				$estado = json_decode($info, true);
				if ($this->checar_codigo($estado) == 2) {
				#exito con la conexion a la api para actualizar las canciones
					$usuario = $estado['data'];
					$usuario['contrasenia'] = $contra;
					//echo '<script>alert("'.$estado['mensaje'].'");</script>';
					$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
					return $vista_principal;
				}else{
					#error al consultar la informacion a la api
					echo '<script>alert("'.$estado['mensaje'].'");</script>';
					$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
					return $vista_principal;
				}
			}
		} else {
			echo '<script>alert("'.$api['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/usuario/funciones_actualizadas', compact("usuario"));
				return $vista_principal;
		}
	}

}