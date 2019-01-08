<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		//$this->load->model('LoginM');
		$this->load->library('session');
	}
	private function checar_codigo($estado){
		if ($estado['codigo'] == 200) {
			#es 1 cuando el codigo de respuesta es de exito
			return 1;
		}elseif ($estado['codigo'] == 201) {
			return 2;
		}else{
			#es 0 cuando el codigo no es de exito
			return 0;
		}
	}
	private function validar_parametros_post($nombre, $contrasenia, $id_tipo){
		if (!empty($nombre) && !empty($contrasenia) && $id_tipo>0) {
			return 1;
			#es 1 cuando los parametros no son vacios
		}else{
			return 0;
			#es 0 cuando un es vacio
		}
	}
	private function validar_parametros_put($id, $nombre, $id_tipo){
		if (!empty($id) && $id>0 &&!empty($nombre) && !empty($id_tipo)) {
			return 1;
			#es 1 cuando el nombre, id y el id_tipo no son vacios y el id > 0
		}else{
			return 0;
			#es 0 cuando el nombre, id o el id_tipo es vacio 
		}
	}
	private function validar_parametros_delete($id){
		if (!empty($id) && $id>0) {
			return 1;
		}else{
			return 0;
		}
	}
	public function index(){
		//$usuario = $this->post('usuario');
		$this->load->view('musica_web/header');
		$this->load->view('musica_web/administrador/principal');
    
	}
	public function canciones(){	
		$respuesta = file_get_contents("https://apimusica.000webhostapp.com/testServer/index.php/api/Canciones/canciones");

		if (!$respuesta) {
			echo '<script>alert("Error al conectar con la api");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}else{
			$estado = json_decode($respuesta, true);
			if ($this->checar_codigo($estado) == 1) {
			#exito con la conexion a la api
				$canciones = $estado['data'];
				$vista_canciones=$this->load->view('musica_web/administrador/canciones', compact("canciones"));
        		return $vista_canciones;
			}else{
				#error al consultar la informacion a la api
				echo '<script>alert("'.$estado['mensaje'].'");</script>';
				$vista_principal = $this->load->view('musica_web/administrador/principal');
				return $vista_principal;
			}
		}
	}
	public function usuarios(){
		$respuesta = file_get_contents("https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios");

		if (!$respuesta) {
			echo '<script>alert("Error al conectar con la api");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}else{
			$estado = json_decode($respuesta, true);
			if ($this->checar_codigo($estado) == 1) {
			#exito con la conexion a la api
				$usuarios = $estado['data'];
				$vista_usuarios=$this->load->view('musica_web/administrador/usuarios', compact("usuarios"));
        		return $vista_usuarios;
			}else{
				#error al consultar la informacion a la api
				echo '<script>alert("'.$estado['mensaje'].'");</script>';
				$vista_principal = $this->load->view('musica_web/administrador/principal');
				return $vista_principal;
			}
		}
	}
	public function inicio(){
		//echo '<script>console.log("estoy en el unicio");</script>';
		//return "pase por el inicio";
		$usuario = $this->input->post();
		//print_r($usuario);
		//$this->load->view('musica_web/header');
		$respuesta = $this->load->view('musica_web/administrador/principal',compact("usuario"));
		return $respuesta;
	}	
	public function agregar(){
		$parametros = $this->input->post();
		//print_r($parametros);
		if($this->validar_parametros_post($parametros['nombre'],$parametros['contrasenia'],$parametros['id_tipo']) == 1){
			//echo '<script>alert("Los campos son validos");</script>';
			$parametros['id_tipo'] = (int)$parametros['id_tipo'];
			header('Content-Type: application/json');
			echo json_encode($parametros, JSON_FORCE_OBJECT);
		}else{
			echo 0;
		}
	}
	public function usuario_agregado(){
		$usuario_nuevo = $this->input->post();
		//print_r($usuario_nuevo);
		if ($this->checar_codigo($usuario_nuevo) == 2) {
			echo '<script>alert("'.$usuario_nuevo['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}else{
			echo '<script>alert("'.$usuario_nuevo['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}
	}
	public function actualizar(){
		$parametros = $this->input->post();
		//print_r($parametros);
		if($this->validar_parametros_put($parametros['id'], $parametros['nombre'], $parametros['id_tipo']) == 1){
			//echo '<script>alert("Los campos son validos");</script>';
			$parametros['id'] = (int)$parametros['id'];
			$parametros['id_tipo'] = (int)$parametros['id_tipo'];
			header('Content-Type: application/json');
			echo json_encode($parametros, JSON_FORCE_OBJECT);
		}else{
			echo 0;
		}
	}
	public function usuario_actualizado(){
		$actualizado = $this->input->post();
		//print_r($actualizado);
		if ($this->checar_codigo($actualizado) == 1) {
			echo '<script>alert("'.$actualizado['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}else{
			echo '<script>alert("'.$actualizado['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}
	}
	public function eliminar_usuario(){
		$eliminar = $this->input->post();
		//print_r($eliminar);
		if ($this->validar_parametros_delete($eliminar['id']) == 1) {
			$eliminar['id'] = (int)$eliminar['id'];
			header('Content-Type: application/json');
			echo json_encode($eliminar, JSON_FORCE_OBJECT);
		} else {
			echo 0;
		}
	}
	public function eliminado(){
		$usuario_eliminado = $this->input->post();
		//print_r($usuario_eliminado);
		if ($this->checar_codigo($usuario_eliminado) == 1) {
			echo '<script>alert("'.$usuario_eliminado['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}else{
			echo '<script>alert("'.$usuario_eliminado['mensaje'].'");</script>';
			$vista_principal = $this->load->view('musica_web/administrador/principal');
			return $vista_principal;
		}
	}
}