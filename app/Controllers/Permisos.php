<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller{
	function __construct(){
		parent:: __construct();
		$this->load->library(array('form_validation','session'));
		$this->load->driver('session');
		$this->load->helper('url');
		$this->load->model('login_model');	
		$this->load->helper(array('auth/login_rules'));		
	}
	public function logout(){
      $this->session->sess_destroy();
      redirect(base_url() );
    }

	/*public function index(){
        //get the posted values
        $username = $this->input->post("txt_username");
        $password= $this->input->post("txt_password"); 

        //set validations
        $this->form_validation->set_rules("txt_username", "Username", "trim|required");
        $this->form_validation->set_rules("txt_password", "Password", "trim|required");

        if ($this->form_validation->run() == FALSE)
        {             
        	$this->load->view('login_view');
        }
        else
        {
             
            if ($this->input->post('btn_login') == "Iniciar Sesion")
            {
                    
                $get_usuario = $this->login_model->get_usuario($username, $password);
                //$get_rut = $this->login_model->get_rut($username, $password); 

                $rut = $get_usuario->rut;
                $iduser = $get_usuario->id;
                $sistema= 'SistemaUsuarios';
                $permiso= $this->login_model->get_nivel($iduser,$sistema);

	             
	            if ($get_usuario){
		          	if ($permiso){		                 
		                $sessiondata = array(
		                     'username' => $username,
		                     'loginuser' => TRUE,
		                     'rut_usuario'=> $rut
		                );
		                $this->session->set_userdata('nivel',$permiso['nivel_acceso']);
		                $this->session->set_userdata('username',$sessiondata['username']);
		                $this->session->set_userdata('rut_usuario',$sessiondata['rut_usuario']);	
		                
 					
 						redirect(base_url('index.php/permisos/administracion') );
 						
 						

		            }else{
			               $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Usted no  tiene permisos para ingresar a este sistema</div>');
			               
			                 redirect($this->uri->uri_string());
	             	  }
	             
		        }else{
		            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Nombre de usuario o contraseña invalidos</div>');
		            redirect($this->uri->uri_string());		                   
		        }
                   
            }
            else

            {  echo "<script>alert('Falló el ingreso');</script>";
                redirect(base_url() );
            }
        }
    }   */ 

    public function index(){
    	$this->load->view('login_view');
    } 
	public function inicio(){ 
		$nivel= $this->session->userdata('nivel');		 
		if ($nivel==4 ){
			redirect(base_url('index.php/permisos/administracion') );	
		}else{
			redirect(base_url('index.php/permisos/feriado_legal'));
		}
	} 
    public function validar(){
    	//get the posted values
    	$this->form_validation->set_error_delimiters('','');
        $username = $this->input->post("txt_username");
        $password=  $this->input->post("txt_password"); 
		/*$rules = getLoginRules();
		$this->form_validation->set_rules($rules);
        */
        //set validations
        $this->form_validation->set_rules("txt_username", "Nombre de usuario", "trim|required" ,
                array('required' => 'El %s es requerido.')
        );
        $this->form_validation->set_rules("txt_password", "Contraseña", "trim|required" ,
                array('required' => 'La %s es requerida.')
        );
        if ($this->form_validation->run() == FALSE){             
        	$this->output->set_status_header(400);
            $errors = array(
            	'username' => form_error('txt_username'),
                'password' => form_error('txt_password'),
            );
            echo json_encode($errors);
        }else{
        	$usr  = $this->input->post("txt_username");
            $pass = $this->input->post("txt_password"); 

            // if(!$res = $this->login_model->login($usr,$pass)){
			if(!$res = $this->login_model->get_user($usr,$pass)){
                echo json_encode(array('msg' => 'Verifique sus credenciales'));
                $this->output->set_status_header(401);
                exit;
            }
           	
            $sistema= 'SistemaUsuarios';  
            $iduser = $res->id;
            $permiso= $this->login_model->get_nivel($iduser,$sistema);
			$administrador = $this->login_model->admin($iduser);			
			$alcalde = $this->login_model->alcalde($iduser);
			
				$sessiondata = array(
					'username' => $res->username,
					'loginuser' => TRUE,
					'rut_usuario'=> $res->rut,
					'nivel' => $permiso['nivel_acceso'],					
					'director'=> $res->director,					
					'jefe' => $res->jefe,					
					'direccion' => $res->direccion,					
					'depto' => $res->departamento,					
					'administrador' => $administrador,					
					'alcalde' => $alcalde,
					'feha_contrato' => $res->fecha_contrato,
				);
			
				$this->session->set_userdata($sessiondata);
				$this->session->set_flashdata('msg','Bienvenido al sistema '.$sessiondata['username']);
				if ($this->input->post("cambiar_pass")!="si") {
					if ($permiso['nivel_acceso']==4 ){
						echo json_encode(array("url" => base_url('index.php/permisos/administracion') ));	
					}else{
						echo json_encode(array("url" => base_url('index.php/permisos/feriado_legal') ));
					}
				}else{
					echo json_encode(array("url" => base_url('index.php/permisos/datos_personales') ));
				}
        }

    }
	//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@********** Cambio contraseña ************@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	public function datos_personales(){
		$username = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut_usuario = $this->session->userdata('rut_usuario'); 
		$data['user'] = $this->login_model->datos_user($rut_usuario);
		if (is_null($username)) {			
			// $this->session->set_flashdata('error_msg', 'Debe iniciar sesión.');
			echo json_encode(array('msg' => 'Debe iniciar sesión'));
			$this->output->set_status_header(401);
			exit;

		}else{			
			$this->load->view('datos_personales',$data);
		}
	}

	public function cambiar_pass(){				
		$rut_usuario = $this->session->userdata('rut_usuario'); 
		$nivel = $this->session->userdata('nivel');
		$cambio = $this->login_model->cambiar_pass($rut_usuario);

		if ($cambio) {				
			// $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Contraseña actualizada</div>');		
			
			$this->session->set_flashdata('success_msg', 'Contraseña actualizada');			
			// if ($nivel== 4 ) {
			// 	redirect(base_url('index.php/solicitud/missolicitudes') );					
			// }else{
			redirect(base_url('index.php/permisos/inicio') );
			// }
		}else{	
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Falló la modificación</div>');		
			redirect(base_url('index.php/permisos/datos_personales'));
		}

	}

    public function administracion(){
    	$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');	
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');		
    	
		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			
			$data['modal']= null;
			$data['user'] = $this->login_model->datos_user($rut);	
			if ($jefe == 'si') {					
				$data['area'] = $depto;		
				$data['funcionarios'] = $this->login_model->get_funcionarios_depto($depto);
				$this->load->view('funcionarios_area',$data);	
			}elseif ($director == 'si') {
				$data['area'] = $direccion;
				$data['funcionarios'] = $this->login_model->get_funcionarios_direccion($direccion);
				$this->load->view('funcionarios_area',$data);						
			}else{
				
				$data['funcionarios'] = $this->login_model->get_funcionarios();
				// $data['deptos'] = $this->login_model->get_departamento();
				$this->load->view('administracion',$data);
			}
		}
    }
	public function admin_dias($rut_funcionario){
    	$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');	
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');		
    	
		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			
			// $data['modal']= null;
				$data['user'] = $this->login_model->datos_user($rut);	
			// if ($jefe == 'si') {					
			// 	$data['area'] = $depto;		
			// 	$data['funcionarios'] = $this->login_model->get_funcionarios_depto($depto);
			// 	$this->load->view('funcionarios_area',$data);	
			// }elseif ($director == 'si') {
			// 	$data['area'] = $direccion;
			// 	$data['funcionarios'] = $this->login_model->get_funcionarios_direccion($direccion);
			// 	$this->load->view('funcionarios_area',$data);						
			// }else{
				$data['rut_funcionario'] = $rut_funcionario;
				$data['dias'] = $this->login_model->get_dias_funcionario($rut_funcionario);
				// $data['deptos'] = $this->login_model->get_departamento();
				$this->load->view('admin_dias',$data);
			// }
		}
    }
	public function agregar_dias(){ 
		$result = $this->login_model->agregar_dias();
		$rut_funcionario = $this->input->post('rut_funcionario');
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Dias agregados');
			redirect(base_url('index.php/permisos/admin_dias/'.$rut_funcionario) );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/admin_dias/'.$rut_funcionario) );
		}	
	} 
    //Agregar Persona
	public function agregarpersona(){
		$existe = $this->login_model->existepersona();
		
		if (!$existe) {
			 
			$result = $this->login_model->agregarpersona();
			if($result){ 
				$this->session->set_flashdata('success_msg', 'Persona agregado');
				redirect(base_url('index.php/permisos/administracion') );
			}else{
				$this->session->set_flashdata('error_msg', $result);		
				redirect(base_url('index.php/permisos/administracion') );
			}	

		}else{
			$this->session->set_flashdata('error_msg', ' Ya existe una persona con este rut');
				redirect(base_url('index.php/permisos/administracion') );
		}		
	}

	//Obtener datos Usuario para Persona
	public function modificarpersona($rut){
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut_user = $this->session->userdata('rut_usuario'); 
		if (is_null($unermane)){		
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
		redirect(base_url() );

		}else{
			$this->session->set_flashdata('modificar', 'Modificar');
			$data['modal']= "Abrir modal";

			$data['persona']= $this->login_model->getpersona($rut);
			$data['user'] = $this->login_model->datos_user($rut);	
			$data['funcionarios'] = $this->login_model->get_funcionarios();
			$data['deptos'] = $this->login_model->get_departamento();
			$this->load->view('administracion',$data);
		}
	}

	// Modificar Persona
	public function actualizarpersona(){
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut_user = $this->session->userdata('rut_usuario'); 

		if (is_null($unermane)){		
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
		redirect(base_url() );

		}else{
			 
			$result = $this->login_model->actualizarpersona();
			if($result){ 
				$this->session->set_flashdata('success_msg', 'Usuario actualizado');
				redirect(base_url('index.php/permisos/administracion') );
			}else{
				$this->session->set_flashdata('error_msg', 'no paso nada');		
				redirect(base_url('index.php/permisos/administracion') );
			}	

		}
	}

	//Pagina de Usuario
	public function user($rut){
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut_user = $this->session->userdata('rut_usuario'); 		
		$data['deptos'] = $this->login_model->get_departamento();			
		$data['user'] = $this->login_model->datos_user($rut_user);	
		$data['persona']	= null;
		$data['permisos'] = null;
		$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');	
		$administrador = $this->session->userdata('administrador');		 			
		$alcalde = $this->session->userdata('alcalde');
		if (is_null($unermane)){		
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );

		}else{
			if ($rut!="new") {
				$datos_user = $this->login_model->datos_user($rut);
				$data['persona']= 	$datos_user;

				$datos_permiso = $this->login_model->get_permisos($datos_user->id);
				$data['permisos'] = $datos_permiso;
				$data['funcion'] = "actualizarpersona";
				if ($jefe == 'si'|| $administrador == 'si' || $alcalde == 'si' || $director == 'si') {					
					$data['jefatura'] = "si";
				}else{
					$data['jefatura'] = "no";
				}
			}else{
				$data['funcion'] = "agregarpersona";
			}
			$this->load->view('usuarios',$data);
		}

	}

	public function agregar_permiso(){
	
			 
		$result = $this->login_model->agregar_permisos();
		$rut_persona = $this->input->post('txt_rut_edit');
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Permiso agregado');
			redirect(base_url('index.php/permisos/user/'.$rut_persona) );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/user/'.$rut_persona) );
		}	

			
	}

	public function actualizar_permisos(){
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut_user = $this->session->userdata('rut_usuario'); 

		if (is_null($unermane)){		
		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );

		}else{
			 
			$result = $this->login_model->actualizar_permisos();
			$rut_persona = $this->input->post('txt_rut_edit');
			if($result){ 
				$this->session->set_flashdata('success_msg', 'Permisos actualizados');
				redirect(base_url('index.php/permisos/user/'.$rut_persona) );
			}else{
				$this->session->set_flashdata('error_msg', 'no paso nada');		
				redirect(base_url('index.php/permisos/user/'.$rut_persona) );
			}	

		}
	}

	public function areas($area, $id){

    	$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		if ($area=="direccion") {
			$data['edit_direccion']= $this->login_model->get_direccion($id);			
		}else{
			$data['edit_direccion']= null;			
		}

		if ($area=="depto") {
			$data['edit_depto']= $this->login_model->get_depto($id);			
		}else{
			$data['edit_depto']= null;		
		}

		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			$data['modal']= null;
			$data['user'] = $this->login_model->datos_user($rut);	
			$data['jefes'] = $this->login_model->get_jefes();
			$data['directores'] = $this->login_model->get_directores();	
			$data['direcciones'] = $this->login_model->get_direcciones();
			$data['deptos'] = $this->login_model->get_departamento();
			$this->load->view('areas',$data);
		}


    }

	public function agregar_direccion(){			 
		
		$nombre = $this->input->post('director');
		$director = $this->login_model->get_rut_director_jefe($nombre);
		$rut = $director->rut."-".$director->dv;
		$result = $this->login_model->agregar_direccion($rut);
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Direccion agregada');
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}				
	}

	public function editar_direccion(){	
		$nombre = $this->input->post('director');
		$director = $this->login_model->get_rut_director_jefe($nombre);
		$rut = $director->rut."-".$director->dv;
		$result = $this->login_model->editar_direccion($rut);
		// $rut_persona = $this->input->post('txt_rut_edit');
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Direccion actualizada');
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}	

			
	}

	public function agregar_depto(){	
		$nombre = $this->input->post('jefe');
		$jefe = $this->login_model->get_rut_director_jefe($nombre);
		$rut = $jefe->rut."-".$jefe->dv;	 

		$direccion = $this->login_model->get_id_direccion($this->input->post('direccion'));	

		$result = $this->login_model->agregar_depto($rut,$direccion->id);
		// $rut_persona = $this->input->post('txt_rut_edit');
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Departamento agregado');
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}	

			
	}
	
	public function editar_depto(){	
		$nombre = $this->input->post('jefe');
		$jefe = $this->login_model->get_rut_director_jefe($nombre);
		$rut = $jefe->rut."-".$jefe->dv;	 	
		$direccion = $this->login_model->get_id_direccion($this->input->post('direccion'));	
		$result = $this->login_model->editar_depto($rut,$direccion->id);
		// $rut_persona = $this->input->post('txt_rut_edit');
		if($result){ 
			$this->session->set_flashdata('success_msg', 'Departamento actualizado');
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}else{
			$this->session->set_flashdata('error_msg', $result);		
			redirect(base_url('index.php/permisos/areas/direcciones/deptos') );
		}	

			
	}

	// *************  Solicitud de feriado Legal
	public function feriado_legal(){	
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');		
		$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');		
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');		 			
		$administrador = $this->session->userdata('administrador');		 			
		$alcalde = $this->session->userdata('alcalde');		 

		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			$data['user'] = $this->login_model->datos_user($rut);	
			$data['funcionarios'] = null;
			if ($jefe == 'si'|| $administrador == 'si' || $alcalde == 'si' || $director == 'si') {					
				$data['jefatura'] = "si";
			}else{
				$data['jefatura'] = "no";
			}
			if ($nivel==4 ) {		
				// echo json_encode(array("url" => base_url('index.php/permisos/admin_solicitudes') ));
				$data['solicitudes'] = $this->login_model->get_solicitudes_rrhh();
				if ($direccion == 'Dirección de Recursos Humanos') {
					$data['pendientes'] = $this->login_model->get_pendientes_rrhh();
				}else {
					$data['pendientes'] = null;
				}
				$this->load->view('admin_solicitudes',$data);

			}else{
				if ($jefe == 'si') {			
					$data['cargo'] = 'Jefe de departamento';		
					$data['solicitudes'] = $this->login_model->get_solicitudes_jefe($depto);					
					$data['pendientes'] = $this->login_model->get_pendientes_jefe($depto);
					$this->load->view('jefatura',$data);
					
				}elseif ($director == 'si' && $administrador != 'si') {
					$data['cargo'] = 'Director';
					$data['solicitudes'] = $this->login_model->get_solicitudes_direccion($direccion);
					$data['pendientes'] = $this->login_model->get_pendientes_direccion($direccion);
					$this->load->view('jefatura',$data);

				}elseif ($administrador == 'si') {			
					$data['cargo'] ='Administrador';	
					$data['solicitudes'] = $this->login_model->get_solicitudes_admin($direccion);
					$data['pendientes'] = $this->login_model->get_pendientes_admin($direccion);
					$this->load->view('jefatura',$data);

				}elseif ($alcalde == 'si') {			
					$data['cargo'] ='Alcalde';	
					$data['solicitudes'] = $this->login_model->get_solicitudes_alcalde($direccion);
					$data['pendientes'] = $this->login_model->get_pendientes_alcalde($direccion);
					$this->load->view('jefatura',$data);	

				}else{
					$data['pendientes'] = $this->login_model->get_pendientes_subrogante($rut);
					$data['cargo'] = '';
					$data['solicitudes'] = $this->login_model->get_solicitudes($rut);
					// echo json_encode(array("url" => base_url('index.php/usuarios/solicitudes') ));
					$this->load->view('solicitudes',$data);
				}
			}
		}
	}	

	public function firmar($id){
		$rut = $this->session->userdata('rut_usuario');
		$aprobar = $this->login_model->aprobar($id,$rut);
		if ($aprobar) {
			$this->session->set_flashdata('success_msg', 'Solicitud aprobada');
			redirect(base_url('index.php/permisos/feriado_legal') );
		}else{
			$this->session->set_flashdata('error_msg', $firmar);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}
		
	}
	public function firmar_subrogante($id){
		$rut = $this->session->userdata('rut_usuario');
		$aprobar = $this->login_model->aprobar_subrogante($id,$rut);
		if ($aprobar) {
			$this->session->set_flashdata('success_msg', 'Solicitud aprobada');
			redirect(base_url('index.php/permisos/feriado_legal') );
		}else{
			$this->session->set_flashdata('error_msg', $firmar);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}
		
	}
	public function timbrar_rrhh($id){
		$rut = $this->session->userdata('rut_usuario');		
		$user = $this->session->userdata('username');
		$solicitud= $this->login_model->get_solicitud($id);	
		$dias = $this->login_model->descontar_dias($solicitud,$rut);
		$aprobar = $this->login_model->timbrar_rrhh($id,$user);

		if ($dias) {
			$this->session->set_flashdata('success_msg', 'Solicitud Timbrada');
			redirect(base_url('index.php/permisos/feriado_legal') );
		}else{
			
			$this->session->set_flashdata('error_msg', $dias);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}
		
	}
	public function firmar_alcalde($id){
		$rut = $this->session->userdata('rut_usuario');		
		$user = $this->session->userdata('username');
		$solicitud= $this->login_model->get_solicitud($id);	
		$dias = $this->login_model->descontar_dias($solicitud,$rut);
		$aprobar = $this->login_model->firmar_alcalde($id,$user);

		if ($dias) {
			$this->session->set_flashdata('success_msg', 'Solicitud Timbrada');
			redirect(base_url('index.php/permisos/feriado_legal') );
		}else{
			
			$this->session->set_flashdata('error_msg', $dias);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}
		
	}
	
	public function rechazar($id){
		$new_estado = $this->input->post('new_estado');		
		$rut = $this->session->userdata('rut_usuario');
		if ($new_estado == "Rechazar"){
			$rechazar = $this->login_model->rechazar($id,$rut);
			$msg = "Solicitud Rechazada";
		}
		else{
			$rechazar = $this->login_model->corregir($id,$rut);
			$msg = "Solicitud enviada a correción";
		}
		
		if ($rechazar) {
			$this->session->set_flashdata('success_msg', $msg);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}else{
			$this->session->set_flashdata('error_msg', $msg);
			redirect(base_url('index.php/permisos/feriado_legal') );
		}
		
	}
	public function mis_solicitudes(){	
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');	
		$administrador = $this->session->userdata('administrador');		 			
		$alcalde = $this->session->userdata('alcalde');
		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			$data['pendientes'] = $this->login_model->get_pendientes_subrogante($rut);
			$data['user'] = $this->login_model->datos_user($rut);	
			if ($jefe == 'si'|| $administrador == 'si' || $alcalde == 'si' || $director == 'si') {					
					$data['jefatura'] = "si";
				}else{
					$data['jefatura'] = "no";
				}
			$data['solicitudes'] = $this->login_model->get_solicitudes($rut);
			// echo json_encode(array("url" => base_url('index.php/permisos/solicitudes') ));
			$this->load->view('solicitudes',$data);
			
		}
	}	

	public function ingresar($funcion){	
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');		
		
		$feha_contrato = $this->session->userdata('feha_contrato');	
		if(is_null($unermane)){		
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Debe inciar sesion antes</div>');
			redirect(base_url() );
		}else{
			//fecha actual	
			$dia=date('d');
			$mes=date('m');
			$anio=date('Y');
			//fecha de contrato
			list($year,$month,$day) = explode("-",$feha_contrato);
			//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
			if (($month == $mes) && ($day > $dia)) {
				$anio=($anio-1); 
			}

			//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
			if ($month > $mes){
				$anio=($anio-1);
			}
			$year_worked= ($anio-$year);
			// echo $year_worked;

			
			if ($year_worked < 15) {
				$dias_fl = 15;
			}elseif ($year_worked >= 15 && $year_worked < 20) {
				$dias_fl = 20;
			}elseif ($year_worked >= 20) {
				$dias_fl = 25;
			}else {
				$dias_fl = 0;
			}
			$dias_ad = 6;
			$dias_adicionales_fl = $this->login_model->get_dias_adicionales_fl($rut);	
			$dias_adicionales_ad = $this->login_model->get_dias_adicionales_ad($rut);

			$dias_ocupados_fl = $this->login_model->get_dias_ocupados_fl($rut);			
			// $dias_ocupados_ad = $this->login_model->get_dias_ocupados_ad($rut);
			$dias_ocupados_ad = $this->login_model->get_dias_F40201($rut);
			$data['dias_F40201'] = $dias_ocupados_ad;
			$data['dias_F40202'] = $this->login_model->get_dias_F40202($rut);
			$data['dias_F40203'] = $this->login_model->get_dias_F40203($rut);
			$data['dias_F40204'] = $this->login_model->get_dias_F40204($rut);
			$data['dias_F40205'] = $this->login_model->get_dias_F40205($rut);
			$data['dias_F40206'] = $dias_ocupados_fl[0]->dias_ocupados;

			$data['dias_fl'] = ($dias_fl - $dias_ocupados_fl[0]->dias_ocupados )+$dias_adicionales_fl[0]->dias;		
				
			$data['dias_ad'] = ($dias_ad- $dias_ocupados_ad->dias_ocupados )+$dias_adicionales_ad[0]->dias;

			$data['user'] = $this->login_model->datos_user($rut);				
			// $data['dias'] = $this->login_model->get_dias($rut);
			$data['subrogantes'] = $this->login_model->get_funcionarios_direccion($direccion);
			
			// $data['solicitudes'] = $this->login_model->get_solicitudes($rut);
			// echo json_encode(array("url" => base_url('index.php/permisos/solicitudes') ));
			if ($funcion == "new") {
				$data['funcion'] = "solicitar";
				$data['solicitud'] = null;
			} else {
				$data['funcion'] = "corregir";
				$data ['solicitud'] = $this->login_model->get_solicitud($funcion);
			}
			$this->load->view('feriado_legal',$data);
			
			
		}
	}	

	public function solicitar(){	
		$rut = $this->session->userdata('rut_usuario');
		$solicitar = $this->login_model->solicitar($rut,'');
		if ($solicitar) {
			$this->session->set_flashdata('success_msg', 'Solicitud enviada');
			redirect(base_url('index.php/permisos/mis_solicitudes') );
		}else{
			$this->session->set_flashdata('error_msg', $solicitar);
			redirect(base_url('index.php/permisos/mis_solicitudes') );
		}
	}
	// public function guardarborrador(){	
	// 	$rut = $this->session->userdata('rut_usuario');
	// 	$solicitar = $this->login_model->solicitar($rut,'borrador');
	// 	if ($solicitar) {
	// 		$this->session->set_flashdata('success_msg', 'Solicitud guardada');
	// 		redirect(base_url('index.php/permisos/mis_solicitudes') );
	// 	}else{
	// 		$this->session->set_flashdata('error_msg', $solicitar);
	// 		redirect(base_url('index.php/permisos/mis_solicitudes') );
	// 	}
	// }
	public function corregir(){	
		
		$id = $this->input->post('id_s');	
		$rut = $this->session->userdata('rut_usuario');
		$actualizar = $this->login_model->actualizar($id);
		if ($actualizar) {
			$this->session->set_flashdata('success_msg', 'Solicitud actualizada');
			redirect(base_url('index.php/permisos/mis_solicitudes') );
		}else{
			$this->session->set_flashdata('error_msg', $actualizar);
			redirect(base_url('index.php/permisos/mis_solicitudes') );
		}
	}

	public function solicitud($id){
		$data ['solicitud'] = $this->login_model->get_solicitud($id);		
	    $html = $this->load->view('doc',$data,true);	 	
	    $pdfFilePath = "Solicitud de Feriado Legal N°".$datos->id_solicitud.".pdf";
	    $this->load->library('M_pdf');	   	
        $mpdf = $pdf = new mPDF('c', 'A4');
 		$pdf->WriteHTML($html);
		ob_end_clean();
		$pdf->Output($pdfFilePath, "I");
	}
	public function reporte(){			
		$this->load->library('Export_excel');
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');				
		$feha_contrato = $this->session->userdata('feha_contrato');	
		$result = $this->login_model->reporte_1($rut);
		$titulo = "Reporte Solicitudes ".$unermane;
		$this->export_excel->to_excel($result,$titulo );
	}
	public function reporte_jefe(){			
		$this->load->library('Export_excel');
		$unermane = $this->session->userdata('username');
		$nivel= $this->session->userdata('nivel');		 
		$rut = $this->session->userdata('rut_usuario');
		$direccion = $this->session->userdata('direccion');				
		$depto = $this->session->userdata('depto');				
		$feha_contrato = $this->session->userdata('feha_contrato');	
		$director = $this->session->userdata('director');		
		$jefe = $this->session->userdata('jefe');		
		$administrador = $this->session->userdata('administrador');		 				
		$alcalde = $this->session->userdata('alcalde');	
		$parametro = null;
		$variable = null;
		if ($jefe == 'si') {
			$parametro = "departamento";
			$variable = $depto;
		}elseif ($administrador == 'si' || $alcalde == 'si' || $director == 'si') {	
			$parametro = "direccion";
			$variable = $direccion;
		}

		$result = $this->login_model->reporte_2($variable,$parametro);
		$titulo = "Reporte Solicitudes ".$variable;
		$this->export_excel->to_excel($result,$titulo );
	}

}