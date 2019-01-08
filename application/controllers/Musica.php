<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musica extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('musica_web/header');
		$this->load->view('musica_web/principal');
		$this->load->view('musica_web/footer');
	}
	private function checar_codigo_login($estado){
		if ($estado['codigo'] == 200) {
			#es 1 cuando el codigo de respuesta es de exito
			return 1;
		}else{
			#es 0 cuando el codigo no es de exito
			return 0;
		}
	}
	public function login(){
		#Recuperamos datos del form y los guardamos en un arreglo
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'contrasenia' => $this->input->post('contrasenia')
			);
		#Validamos que no esten vacios los campos, se mandan alerts
		if(empty($data['nombre'])){
			$this->load->view('musica_web/header');
			$this->load->view('musica_web/principal');
			echo '<script>alert("Ingresa un nombre");</script>';
		}
		elseif(empty($data['contrasenia'])){
			$this->load->view('musica_web/header');
			$this->load->view('musica_web/principal');
			echo '<script>alert("Ingresa una Contraseña");</script>';
		}
		#Si no estan vacios...
		else{
			#Checamos en el modelo si eciste el usuario 
			//echo "no estan vacios";
			$nombre = str_replace(" ","%20",$data['nombre']);
			$respuesta = file_get_contents("https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios?nombre=".$nombre."&contrasenia=".$data['contrasenia']);

			if (!$respuesta) {
				echo '<script>alert("Error al conectar con la api");</script>';
				$this->load->view('musica_web/header');
				$this->load->view('musica_web/principal');
			}else{
				$estado = json_decode($respuesta, true);
				if ($this->checar_codigo_login($estado) == 1) {
				#exito con la conexion a la api
					$usuario = $estado['data'];
					if ($usuario['activo'] == 1) {
						#el usuario no ha sido eliminado
						if ($usuario['id_tipo'] == 2) {
							#es tipo usuario
							$aux['nombre'] = $usuario['nombre'];
							$usuario['contrasenia'] = $data['contrasenia'];
							$this->load->view('musica_web/usuario/header', $aux);
							$this->load->view('musica_web/usuario/principal', compact("usuario"));
							$this->load->view('musica_web/usuario/footer');
						}else{
							#es tipo administrador
							print_r($usuario);
							$this->load->view('musica_web/administrador/header');
							$this->load->view('musica_web/administrador/principal', compact("usuario"));
							$this->load->view('musica_web/administrador/footer');
						}
					}else{
						#el usuario ya fue eliminado
						echo '<script>alert("Este usuario ya fue eliminado");</script>';
						$this->load->view('musica_web/header');
						$this->load->view('musica_web/principal');
					}
					//echo($usuario['mensaje']);
				}else{
					#error al consultar la informacion a la api
					echo '<script>alert("'.$estado['mensaje'].'");</script>';
					$this->load->view('musica_web/header');
				    $this->load->view('musica_web/principal');
				}

				//print_r($usuario['codigo']);
			}
			/*if($idTipo_Usuario == 1){
				#existe como Administrador
				#recupero el id del usuario y se guarda la session
								echo("Admin");
				$this->load->view('musica_web/header');
				$this->load->view('Administrador/inicioAdmin',$data);
			}
			elseif($idTipo_Usuario == 2){
				#existe como Usuario
				#recupero el id del usuario y se guarda la session
				$usuario_data = array(
					'id' => $idUsuario,
					);
				
				if ($idsPlay->num_rows() == 1) {
					$play1 = $idsPlay->result()[0]->id;
					$data['play1'] = $this->LoginM->InfoPlay($play1);
				}if ($idsPlay->num_rows() == 2){
					$play1 = $idsPlay->result()[0]->id;
					$play2 = $idsPlay->result()[1]->id;
					$data['play1'] = $this->LoginM->InfoPlay($play1);
					$data['play2'] = $this->LoginM->InfoPlay($play2);
				}
		
				$data['numPlay'] = $aux;
				$this->load->view('musica_web/header');
				$this->load->view('Usuario/inicioUsuario',$data);
			}else{
				#El usuario no existe
				$this->load->view('musica_web/header');
				$this->load->view('musica_web/principal');
				echo '<script>alert("Usuario sin registro");</script>';
			}*/
		}
	}

	function Salir(){
		$this->session->sess_destroy();
		$this->load->view('musica_web/header');
		$this->load->view('musica_web/principal');
		$this->load->view('musica_web/footer');
	}
}
