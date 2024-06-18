<?php defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model
{

     function __construct(){
          parent::__construct();
          $this->dbusuarios = $this->load->database('default', TRUE);
          $this->load->library('encryption');
          $key  =  $this->encryption->create_key( 16 );
     }
     public function login($usr, $pass){
        $data = $this->db->get_where('usuario',array('username' => $usr,'password' => $pass));
        if(!$data->result()){
            return false;
        }
        return $data->row();
     }
     function get_user($usr, $pwd){    
          $data = $this->db->get_where('sistemas_users',array('username' => $usr,'password' => $pwd));
          if(!$data->result()){
          return false;
          }
          return $data->row();     
          
          // $sql = "select * from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          // $query = $this->dbusuarios->query($sql);
          // if($query->num_rows() > 0){
          //      return $query->row_array();
          // }else{
          //      return false;
          // }
          
     }
     function datos_user($rut){
          $this->db->select('*' );      
          $this->db->where('rut', $rut);
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     } 
     function cambiar_pass($rut){		
		$field = array(
		'password'=>$this->input->post('new_pass')
		);
		$this->db->where('rut', $rut);
		$this->db->update('sistemas_users', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

     }
     function get_rut_director_jefe($nombre){
          $this->db->select('rut,dv' );      
          $this->db->where('CONCAT(nombre," ",apellido) =', $nombre);
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     function get_id_direccion($nombre){
          $this->db->select('id' );      
          $this->db->where('nombre', $nombre);
          // $query = $this->db->get('persona');
          $query = $this->db->get('direccion');
         if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     function get_usuario($usr, $pwd){
          $this->db->select('*' ); 
          $this->db->where('username', $usr);
          $this->db->where('password', $pwd);
          $query = $this->db->get('usuario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     function get_rut($user, $pwd){
          $sql = "select rut from usuario where username = '" . $user . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);

          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          } 
     }
     function get_nivel($id, $idS){
          $this->db->select('nivel_acceso');      
          $this->db->where('id_sistema', $idS);
          $this->db->where('id_usuario', $id);
          $query = $this->db->get('sistemas_sistemasxusuario');
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          }
     }
     function form_insert($data){
          // Inserting in Table(students) of Database(college)
          $this->db->insert('persona', $data);
     }
     /*****  ******/
     function get_departamento (){  
          $this->db->select('
              a.id as id , 
              a.nombre as nombre,
              a.id_direccion as id_direccion,
              d.nombre as nombre_direccion,
              a.rut_encargado as rut_encargado,
              CONCAT(s.nombre," ",s.apellido) as nombre_jefe
              ' );     
          $this->db->join('direccion d', 'a.id_direccion= d.id', 'left');              
          $this->db->join('sistemas_users s', 's.rut= a.rut_encargado', 'left');   
          $this->db->order_by('a.nombre','asc');	 
          $query = $this->db->get('departamento a');          
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }    
     function get_direcciones (){
          $this->db->select('
              a.id as id , 
              a.nombre as nombre,
              a.rut_director as rut_director,
              CONCAT(b.rut,"-",b.dv) as rut_direc,
              CONCAT(b.nombre," ",b.apellido) as nombre_director,' );     
          $this->db->join('sistemas_users b', 'a.rut_director= CONCAT(b.rut,"-",b.dv)', 'left');
          $this->db->order_by('a.nombre','asc');	 
          $query = $this->db->get('direccion a');          
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     function get_funcionarios(){
          // $this->db->select('
          //      a.rut as rut , 
          //      a.dv as dv,
          //      a.nombres as nombres , 
          //      a.apellido_paterno as apellido_paterno, 
          //      a.apellido_materno as apellido_materno,
          //      a.id_departamento  as id_departamento,
          //      a.cargo_funcion as cargo_funcion,
          //      a.email as email,
          //      a.estado as estado,
          //      a.telefono as telefono,
          //      a.sexo as sexo,
          //      a.tipo_persona as tipo_persona,
          //      a.foto  as foto,
          //      b.nombre as departamento,
          //      c.nombre as direccion,
          //      d.id as userid,
          //      d.estado as estadousuario,
          //      d.username as username' );     
          // $this->db->join('departamento b', 'a.id_departamento= b.id', 'left');
          // $this->db->join('direccion c', 'b.id_direccion = c.id', 'left');
          // $this->db->join('usuario d', 'd.rut = a.rut', 'left');

          // $query = $this->db->get('persona a');
          
          $this->db->order_by('nombre','asc');	
          $query = $this->db->get('sistemas_users');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     function get_funcionarios_depto($depto){
          
          $this->db->where('departamento',$depto); 
          $this->db->order_by('nombre','asc');	
          $query = $this->db->get('sistemas_users');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     function get_funcionarios_direccion($direccion){
          
          $this->db->where('direccion',$direccion); 
          $this->db->order_by('nombre','asc');	
          $query = $this->db->get('sistemas_users');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     public function existepersona(){
          $rut = $this->input->post('txt_rut');

          $this->db->select('*' );      
          $this->db->where('rut', $rut);
          $query = $this->db->get('persona');
          if($query->num_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function getpersona($rut){
           $this->db->select('
               a.rut as rut , 
               a.dv as dv,
               a.nombres as nombres , 
               a.apellido_paterno as apellido_paterno, 
               a.apellido_materno as apellido_materno,
               a.id_departamento  as id_departamento,
               a.cargo_funcion as cargo_funcion,
               a.email as email,
               a.estado as estado,
               a.telefono as telefono,
               a.sexo as sexo,
               a.tipo_persona as tipo_persona,
               a.foto  as foto,
               b.nombre as departamento,
               c.nombre as direccion' );     
          $this->db->join('departamento b', 'a.id_departamento= b.id', 'left');
          $this->db->join('direccion c', 'b.id_direccion = c.id', 'left');
          $this->db->where('rut', $rut);
          $query = $this->db->get('persona a');

          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     function get_idusuario($rut){
          $this->db->select('*' ); 
          $this->db->where('rut', $rut);
          $query = $this->db->get('usuario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     function get_permisos($id){
          $this->db->select(' 
          a.id_permiso as id_permiso,
          a.id_sistema as id_sistema,
          a.id_usuario as id_usuario,
          a.nivel_acceso as nivel_acceso,
          a.tipoadmin as tipoadmin,
          a.estado as estado,
          b.rut as rut,
          b.id as id,');
          $this->db->having('a.id_usuario', $id);
          $this->db->join('usuario b', 'a.id_usuario =b.id', 'left');         
          $query = $this->db->get('sistemas_sistemasxusuario a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     public function agregarpersona(){
          $field = array(                 
          'rut'             =>$this->input->post('txt_rut_edit'),
          'dv'              =>$this->input->post('txt_dv_edit'),           
          'nombre'          =>$this->input->post('txt_nombres_edit'),
          'apellido'        =>$this->input->post('txt_ap_edit'),
          'departamento'    =>$this->input->post('txt_departamento_edit'),
          'cargo'           =>$this->input->post('txt_cargo_edit'),
          'mail'            =>$this->input->post('txt_email'),
          'telefono'        =>$this->input->post('txt_telefono_edit'),
          'sexo'            =>$this->input->post('txt_sexo_edit'),
          'foto'            =>$this->input->post('txt_foto_edit'),
          'calidad_juridica'=>$this->input->post('calidad_juridica'),
          'grado'           =>$this->input->post('grado'),
          'escalafon'       =>$this->input->post('escalafon'),
          'username'        =>$this->input->post('username'),
          'password'        =>$this->input->post('password')
          );
          $this->db->insert('sistemas_users', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function actualizarpersona(){
          $rut = $this->input->post('txt_rut_edit');
          $field = array(                                
               'rut'             =>$this->input->post('txt_rut_edit'),
               'dv'              =>$this->input->post('txt_dv_edit'),           
               'nombre'          =>$this->input->post('txt_nombres_edit'),
               'apellido'        =>$this->input->post('txt_ap_edit'),
               'departamento'    =>$this->input->post('txt_departamento_edit'),
               'cargo'           =>$this->input->post('txt_cargo_edit'),
               'mail'            =>$this->input->post('txt_email'),
               'telefono'        =>$this->input->post('txt_telefono_edit'),
               'sexo'            =>$this->input->post('txt_sexo_edit'),
               'foto'            =>$this->input->post('txt_foto_edit'),
               'calidad_juridica'=>$this->input->post('calidad_juridica'),
               'grado'           =>$this->input->post('grado'),
               'escalafon'       =>$this->input->post('escalafon'),
               'username'        =>$this->input->post('username'),
               'password'        =>$this->input->post('password')
          );
          $this->db->where('rut',$rut);
          $this->db->update('sistemas_users', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function agregar_permisos(){
          $field = array(                 
          'id_usuario'              =>$this->input->post('txt_id_user'),     
          'id_sistema'              =>$this->input->post('txt_sistema'),        
          'nivel_acceso'          =>$this->input->post('txt_nivel'),
          'tipoadmin'        =>$this->input->post('txt_tipoadmin'),
          'estado'    =>$this->input->post('txt_estado')
          );
          $this->db->insert('sistemas_sistemasxusuario', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function agregar_dias(){
          if ($this->input->post('compensatorio')=="si") {
               $horas  = $this->input->post('horas');
               $dias = $horas/8;
          }else{
               $dias = $this->input->post('dias');
          }

          $field = array(                 
          'rut_funcionario'  =>$this->input->post('rut_funcionario'),     
          'dias'             =>$dias,        
          'tipo'             =>$this->input->post('tipo'),          
          'observacion'      =>$this->input->post('observacion'),
          'estado'             =>"adicionales"
          );
          $this->db->insert('sfl_dias_funcionario', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function actualizar_permisos(){
		
		$array_id 	     = $_POST['idP'];
		$array_sistema      = $_POST['txt_sistema'];
		$array_nivel	     = $_POST['txt_nivel'];
		$array_tipoadmin    = $_POST['txt_tipoadmin'];
		$array_estado		= $_POST['txt_estado'];
		

		
		$permisos = array();
		//Obtenemos cada clave y su valor para poder contar la cantidad de datos e ingresarlos acorde a cada clave
		foreach ($array_id as $clave=>$idpermiso) {		 	
			$sistema 	     = $array_sistema[$clave];
			$nivel		= $array_nivel[$clave] ;
			$tipoadmin	= $array_tipoadmin[$clave] ;
			$estado	     = $array_estado[$clave] ;
			
			$permisos[] = array(
					'id_permiso'	=>$idpermiso,
		               'id_sistema'	=>$sistema,
					'nivel_acceso'	=>$nivel,
					'tipoadmin'	=>$tipoadmin,
					'estado'	     =>$estado,

		     );
		}
		$this->db->update_batch('sistemas_sistemasxusuario', $permisos, 'id_permiso'); 
		 
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
     public function agregar_direccion($rut){
          
          $field = array(                 
          'nombre'       =>$this->input->post('nombre_direccion'),     
          'rut_director' =>$rut
          );
          $this->db->insert('direccion', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function agregar_depto($rut,$id){
          $field = array(                 
          'nombre'        =>$this->input->post('nombre_departamento'),     
          'id_direccion'  =>$id,        
          'rut_encargado' =>$rut
          );
          $this->db->insert('departamento', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     function get_depto ($id){
          $this->db->select('
              a.id as id , 
              a.nombre as nombre,
              a.id_direccion as id_direccion,
              d.nombre as nombre_direccion,
              a.rut_encargado as rut_encargado,
              CONCAT(s.nombre," ",s.apellido) as nombre_jefe
              ' );     
          $this->db->join('direccion d', 'a.id_direccion= d.id', 'left');              
          $this->db->join('sistemas_users s', 's.rut= a.rut_encargado', 'left');   
          $this->db->where('a.id', $id);
          $query = $this->db->get('departamento a');            
          if($query->num_rows() > 0){
               return  $query->row();
          }else{
               return false;
          }
     }    
     function get_direccion ($id){
          $this->db->select('
          a.id as id , 
          a.nombre as nombre,
          a.rut_director as rut_director,
          CONCAT(b.rut,"-",b.dv) as rut_direc,
          CONCAT(b.nombre," ",b.apellido) as nombre_director,' );     
          $this->db->join('sistemas_users b', 'a.rut_director= CONCAT(b.rut,"-",b.dv)', 'left'); 
          $this->db->where('a.id', $id);	 
          $query = $this->db->get('direccion a');          
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     public function editar_direccion($rut){
          $id = $this->input->post('id_direccion');
          $field = array(                 
               'nombre'       =>$this->input->post('nombre_direccion'),     
               'rut_director' =>$rut
               );
          $this->db->where('id',$id);
          $this->db->update('direccion', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function editar_depto($rut,$id_d){
          $id = $this->input->post('id_depto');
          $field = array(                 
               'nombre'        =>$this->input->post('nombre_departamento'),     
               'id_direccion'  =>$id_d,        
               'rut_encargado' =>$rut
          );
          $this->db->where('id',$id);
          $this->db->update('departamento', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     function get_directores(){
          $this->db->select('id, rut,dv, nombre, apellido' );   
          $this->db->like('cargo', 'director');   
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     function get_jefes(){
          $this->db->select('id, rut,dv, nombre, apellido' );   
          $this->db->where("(cargo LIKE '%encargado%' OR cargo LIKE '%jefe%')", NULL, FALSE); 
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     function admin($id){
          $this->db->where('id',$id); 
          $this->db->where("(cargo LIKE '%Administrador Municipal%' )", NULL, FALSE); 
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return 'si';
          }else{
               return 'no';
          }
     }
     function alcalde($id){
          $this->db->where('id',$id); 
          $this->db->where("(cargo LIKE '%Alcalde%' )", NULL, FALSE); 
          // $query = $this->db->get('persona');
          $query = $this->db->get('sistemas_users');
         if($query->num_rows() > 0){
               return 'si';
          }else{
               return 'no';
          }
     }

	// *************  Solicitud de feriado Legal
     public function  get_solicitudes($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,          
          a.tipo_solicitud as tipo_solicitud,
          a.estado as estado,
          a.motivo as motivo,
          a.nombre_rrhh as nombre_rrhh,');
          
          if ($dat!='all') {               
               $this->db->having('a.rut_solicitante', $dat);
          }                                             
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
		$this->db->order_by('a.id','DESC');		    
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_solicitudes_rrhh(){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,          
          a.tipo_solicitud as tipo_solicitud,
          a.estado as estado,
          a.motivo as motivo,
          a.nombre_rrhh as nombre_rrhh,
          ');
          
          $this->db->where('a.estado !=', 'Pendiente de aprobación'); 
          $this->db->where('a.estado !=', 'En correción'); 
          $this->db->where('a.estado !=', 'Rechazada '); 
		$this->db->where('a.estado !=', 'Pendiente Firma Subrogancia');     
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
		$this->db->order_by('a.id','DESC');		    
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_solicitudes_direccion($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          a.estado as estado,
          a.observacion as observacion,
          a.nombre_rrhh as nombre_rrhh,');     
          
          $this->db->where('a.estado !=', 'Pendiente de aprobación'); 
          $this->db->where('a.estado !=', 'En correción'); 
          $this->db->where('a.estado !=', 'Rechazada '); 
		$this->db->where('a.estado !=', 'Pendiente Firma Subrogancia');  
          $this->db->having('b.direccion', $dat);                   
          $this->db->having('b.escalafon', 'Profesionales');
          $this->db->or_having('b.escalafon', 'Jefaturas');          
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');       
		$this->db->order_by('a.id','DESC');		      
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_pendientes_direccion($dat){ 
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          a.estado as estado,
          a.observacion as observacion,');     

          $this->db->where('a.estado', 'Pendiente de aprobación');  
          $this->db->having('b.direccion', $dat);                         
          $this->db->having('b.escalafon', 'Profesionales');
          $this->db->or_having('b.escalafon', 'Jefaturas');             
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');     
		$this->db->order_by('a.id','DESC');		        
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_solicitudes_jefe($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          a.estado as estado,
          a.observacion as observacion,
          a.nombre_rrhh as nombre_rrhh,');      
          $this->db->where('a.estado !=', 'Pendiente de aprobación'); 
          $this->db->where('a.estado !=', 'En correción'); 
          $this->db->where('a.estado !=', 'Rechazada '); 
		$this->db->where('a.estado !=', 'Pendiente Firma Subrogancia');  

          $this->db->having('b.departamento', $dat);                         
          $this->db->having('b.escalafon', 'Técnicos');                        
          $this->db->or_having('b.escalafon', 'Auxiliares');                                  
          $this->db->or_having('b.escalafon', 'Administrativos'); 
          // $this->db->having('b.jefe', 'si');         
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
		$this->db->order_by('a.id','desc');		    
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_pendientes_jefe($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          a.estado as estado,
          a.observacion as observacion,');  
          
		// $this->db->where('a.estado !=', 'Rechazada');   
		// $this->db->where('a.estado !=', 'Aprobada');
		// $this->db->where('a.estado !=', 'En correción');  
		// $this->db->where('a.estado !=', 'Pendiente Firma Subrogancia');  
		// $this->db->where('a.estado !=', 'Timbrada por RRHH');  
		// $this->db->where('a.estado !=', 'Pendiente de Timbre RRHH');  
                            
          $this->db->where('a.estado', 'Pendiente de aprobación');  
          $this->db->having('b.departamento', $dat);                              
          $this->db->having('b.escalafon', 'Técnicos');                        
          $this->db->or_having('b.escalafon', 'Auxiliares');                                  
          $this->db->or_having('b.escalafon', 'Administrativos');      
          // $this->db->having('b.jefe', 'si');         
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');          
		$this->db->order_by('a.id','DESC');		   
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     public function  get_solicitudes_admin($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.director as director,
          a.estado as estado,
          a.observacion as observacion,
          a.nombre_rrhh as nombre_rrhh,');     
          
          $this->db->where('a.estado !=', 'Pendiente de aprobación'); 
          $this->db->having('b.direccion', $dat);    
          // $this->db->having('b.departamento', $dat);  
          $this->db->or_having('b.director', 'si');                   
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
		$this->db->order_by('a.id','DESC');		    
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_pendientes_admin($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.director as director,
          a.estado as estado,
          a.observacion as observacion,');     
                    
          $this->db->where('a.estado', 'Pendiente de aprobación'); 
          $this->db->having('b.direccion', $dat);    
          // $this->db->having('b.departamento', $dat);               
          $this->db->or_having('b.director', 'si');                   
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');       
		$this->db->order_by('a.id','DESC');		
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_solicitudes_alcalde($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.director as director,
          b.cargo as cargo,
          a.estado as estado,
          a.observacion as observacion,
          a.nombre_rrhh as nombre_rrhh,');     
          
          $this->db->where('a.estado !=', 'Pendiente de aprobación'); 
          // $this->db->having('b.direccion', $dat);    
          // $this->db->having('b.departamento', $dat);  
          $this->db->or_having('b.cargo', 'Administrador Municipal');                   
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
		$this->db->order_by('a.id','DESC');		    
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_pendientes_alcalde($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.director as director,
          b.cargo as cargo,
          a.estado as estado,
          a.observacion as observacion,');     
                    
          $this->db->where('a.estado', 'Pendiente de aprobación'); 
          // $this->db->having('b.direccion', $dat);    
          // $this->db->having('b.departamento', $dat);   
          $this->db->or_having('b.cargo', 'Administrador Municipal');                  
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');       
		$this->db->order_by('a.id','DESC');		
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_pendientes_subrogante($dat){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          a.estado as estado,
          a.observacion as observacion,
          a.firma_subrogante as firma_subrogante,
          a.rut_subrogante as rut_subrogante,');        
          
          $this->db->where('a.estado', 'Pendiente Firma Subrogancia');      
          $this->db->having('a.rut_subrogante', $dat);             
          // $this->db->having('b.jefe', 'si');         
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');          
		$this->db->order_by('a.id','DESC');		   
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     public function  get_pendientes_rrhh(){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,  
          a.tipo_solicitud as tipo_solicitud,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.escalafon as escalafon,
          b.cargo as cargo,
          a.estado as estado,
          a.observacion as observacion,
          a.firma_subrogante as firma_subrogante,
          a.rut_subrogante as rut_subrogante,');        
          
          // $this->db->where('a.estado !=', 'Timbrada por RRHH'); 
          $this->db->where('a.estado', 'Pendiente de Timbre RRHH');       
          $this->db->or_where('b.cargo', 'Alcalde');           
          $this->db->having('a.estado !=', 'Timbrada por RRHH');    
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');          
		$this->db->order_by('a.id','DESC');		   
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }
     public function  get_dias_ocupados_fl($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('tipo',"FERIADO LEGAL");     
                
          $this->db->where('estado',"ocupados"); 
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_dias_ocupados_ad($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('tipo',"ADMINISTRATIVO");       
                
          $this->db->where('estado',"ocupados");            
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_dias_adicionales_fl($rut){
          $this->db->select_sum('dias', 'dias');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('tipo',"FERIADO LEGAL");        
          $this->db->where('estado',"adicionales");  
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_dias_adicionales_ad($rut){
          $this->db->select_sum('dias', 'dias');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('tipo',"ADMINISTRATIVO");       
          $this->db->where('estado',"adicionales");                
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }

     }
     public function  get_dias_F40201($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('formulario',"PERMISO CON GOCE DE REMUNERACIONES");    
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }

     }
     public function  get_dias_F40202($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('formulario',"PERMISO SIN GOCE DE REMUNERACIONES");    
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }

     }
     public function  get_dias_F40203($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('formulario',"PERMISO POSTNATAL PARENTAL");    
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     public function  get_dias_F40204($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('formulario',"PERMISO GREMIAL");    
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     public function  get_dias_F40205($rut){
          $this->db->select_sum('dias', 'dias_ocupados');
          $this->db->where('rut_funcionario', $rut);     
          $this->db->where('formulario',"DESCANSO COMPLEMENTARIO");    
          $query = $this->db->get('sfl_dias_funcionario');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }
     }
     public function  get_solicitud($id){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,
          a.rut_solicitante as rut_solicitante,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          a.tipo_solicitud    as tipo_solicitud ,
          a.estado            as estado         ,
          a.meses_pedidos     as meses_pedidos  ,
          a.semanas_pedidas   as semanas_pedidas,
          a.medio_dia         as medio_dia      ,
          a.beneficiario      as beneficiario   ,
          a.reintegro         as reintegro      ,
          a.tiempo            as tiempo         ,
          a.hora_desde        as hora_desde     ,
          a.hora_hasta        as hora_hasta     ,
          a.horas             as horas          ,
          a.minutos           as minutos        ,
          a.desde_alcalde     as desde_alcalde  ,
          a.hasta_alcalde     as hasta_alcalde  ,
          a.accion_alcalde    as accion_alcalde ,
          a.year              as year           ,          
          a.motivo            as motivo         ,
          b.rut as rut,
          b.nombre as nombre,
          b.apellido as apellido,
          b.direccion as direccion,
          b.departamento as departamento,
          b.calidad_juridica as calidad_juridica,
          b.grado as grado,
          b.escalafon as escalafon,          
          b.cargo as cargo,
          a.rut_firma as rut_firma,
          a.firma_rrhh as firma_rrhh,
          a.firma_subrogante as firma_subrogante,
          a.rut_subrogante as rut_subrogante,');   
                               
          $this->db->having('a.id', $id);                                                  
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
          $query = $this->db->get('sfl_solicitud a');
          if($query->num_rows() > 0){
               return $query->row();
          }else{
               return false;
          }

     }
     public function  get_dias_funcionario($rut){
          $this->db->select('
          a.id as id,
          a.id_solicitud as id_solicitud,
          a.rut_funcionario as rut,
          a.dias as dias,
          a.observacion as observacion,
          a.tipo as tipo,
          a.formulario as formulario,
          a.estado  as estado,
          b.nombre as nombre,
          b.apellido as apellido,
          b.dv as dv,
          b.direccion as direccion ,
          b.departamento as departamento,
          ');
          $this->db->having('rut_funcionario', $rut);             
          $this->db->join('sistemas_users b', 'a.rut_funcionario =b.rut', 'left');
          $query = $this->db->get('sfl_dias_funcionario a');
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
     }

     public function solicitar($rut,$estado){
          $hoy = date('y-m-d');
          $rut_subrogante= $this->input->post('rut_subrogante');
          if ($estado != '') {
               $estado= "En correción";
          }elseif ($rut_subrogante == "") {
               $estado= "Pendiente de aprobación";
          }else {
               $estado= "Pendiente Firma Subrogancia";
          }
          $motivo = null;
          if ($this->input->post('tipo_solicitud') == "PERMISO CON GOCE DE REMUNERACIONES") {
               $motivo = $this->input->post('motivo_1');
          }
          if ($this->input->post('tipo_solicitud') == "PERMISO SIN GOCE DE REMUNERACIONES") {
               $motivo = $this->input->post('motivo_2');
          }
          if ($this->input->post('tipo_solicitud') == "DESCANSO COMPLEMENTARIO") {
               $motivo = $this->input->post('motivo_3');
          }          
          if ($motivo=="OTRO") {
               $motivo = $this->input->post('motivo_otro');
          }

          $field = array(                
               'fecha'             => $hoy ,
               'rut_solicitante'   => $rut,
               'fecha_inicio'      => $this->input->post('desde'),        
               'fecha_termino'     => $this->input->post('hasta'),       
               'dias'              => $this->input->post('dias_pedidos'),
               'estado'            => $estado,                
               'tipo_solicitud'    => $this->input->post('tipo_solicitud'),
               'meses_pedidos'     => $this->input->post('meses_pedidos'),
               'semanas_pedidas'   => $this->input->post('semanas_pedidas'),
               'medio_dia'         => $this->input->post('medio_dia'),
               'beneficiario'      => $this->input->post('beneficiario'),
               'reintegro'         => $this->input->post('reintegro'),
               'tiempo'            => $this->input->post('tiempo'),
               'hora_desde'        => $this->input->post('hora_desde'),
               'hora_hasta'        => $this->input->post('hora_hasta'),
               'horas'             => $this->input->post('horas'),
               'minutos'           => $this->input->post('minutos'),
               'desde_alcalde'     => $this->input->post('desde_alcalde'),
               'hasta_alcalde'     => $this->input->post('hasta_alcalde'),
               'accion_alcalde'    => $this->input->post('accion_alcalde'),
               'year'              => $this->input->post('year_alcalde'),
               'motivo'            => $motivo,
               'rut_subrogante'    => $rut_subrogante ,
               
               );
          // $this->db->where('id',$id);
          $this->db->insert('sfl_solicitud', $field);
         if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function actualizar($id){
          $hoy = date('y-m-d');
          $rut_subrogante= $this->input->post('rut_subrogante');
          if ($rut_subrogante == "") {
               $estado= "Pendiente de aprobación";
          }else {
               $estado= "Pendiente Firma Subrogancia";
          }
          $motivo = null;
          if ($this->input->post('tipo_solicitud') == "PERMISO CON GOCE DE REMUNERACIONES") {
               $motivo = $this->input->post('motivo_1');
          }
          if ($this->input->post('tipo_solicitud') == "PERMISO SIN GOCE DE REMUNERACIONES") {
               $motivo = $this->input->post('motivo_2');
          }
          if ($this->input->post('tipo_solicitud') == "DESCANSO COMPLEMENTARIO") {
               $motivo = $this->input->post('motivo_3');
          }          
          if ($motivo=="OTRO") {
               $motivo = $this->input->post('motivo_otro');
          }

          $field = array(                
               'fecha'             => $hoy,               
               'fecha_inicio'      => $this->input->post('desde'),        
               'fecha_termino'     => $this->input->post('hasta'),       
               'dias'              => $this->input->post('dias_pedidos'),
               'estado'            => $estado,                
               'tipo_solicitud'    => $this->input->post('tipo_solicitud'),
               'meses_pedidos'     => $this->input->post('meses_pedidos'),
               'semanas_pedidas'   => $this->input->post('semanas_pedidas'),
               'medio_dia'         => $this->input->post('medio_dia'),
               'beneficiario'      => $this->input->post('beneficiario'),
               'reintegro'         => $this->input->post('reintegro'),
               'tiempo'            => $this->input->post('tiempo'),
               'hora_desde'        => $this->input->post('hora_desde'),
               'hora_hasta'        => $this->input->post('hora_hasta'),
               'horas'             => $this->input->post('horas'),
               'minutos'           => $this->input->post('minutos'),
               'desde_alcalde'     => $this->input->post('desde_alcalde'),
               'hasta_alcalde'     => $this->input->post('hasta_alcalde'),
               'accion_alcalde'    => $this->input->post('accion_alcalde'),
               'year'              => $this->input->post('year_alcalde'),
               'motivo'            => $motivo,
               'rut_subrogante'    => $rut_subrogante ,
               
               );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
         if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function aprobar_subrogante($id,$rut){
          $field = array(                 
               'estado'       =>"Pendiente de aprobación",     
               'firma_subrogante' =>"si"
               );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }

     public function timbrar_rrhh($id,$user){

          $field = array(                 
               'estado'       =>"Timbrada por RRHH",     
               'firma_rrhh'   =>11751374,                       
               'nombre_rrhh'   =>$user   
          );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
      public function firmar_alcalde($id,$user){

          $field = array(                 
               'estado'       =>"Timbrada por RRHH",     
               'firma_rrhh'   =>11751374,        
               'rut_firma'    =>11738078,       
               'nombre_rrhh'   =>$user   
          );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function descontar_dias($solicitud,$rut){
          if ($solicitud->tipo_solicitud== "FERIADO LEGAL") {
               $tipo ="FERIADO LEGAL";
          }elseif ($solicitud->tipo_solicitud== "PERMISO CON GOCE DE REMUNERACIONES") {
               $tipo = "ADMINISTRATIVO";
          }else {
               $tipo = "";
          }
          $field = array(                    
               'rut_funcionario'   =>intval($solicitud->rut_solicitante), 
               'dias'              =>$solicitud->dias, 
               // 'observacion '      =>"Feriado Legal", 
               'id_solicitud'      =>$solicitud->id,               
               'tipo '             =>$tipo,    
               'formulario '       =>$solicitud->tipo_solicitud,             
               'estado'            =>"ocupados",     
          );
          $this->db->insert('sfl_dias_funcionario', $field);
          // return $this->db->last_query();
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function aprobar($id,$rut){
          $field = array(                 
               'estado'       =>"Pendiente de Timbre RRHH",     
               'rut_firma' =>$rut
               );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }
     public function rechazar($id,$rut){
          $field = array(                 
               'estado'       =>"Rechazada",     
               'observacion' =>$this->input->post('txt_observacion')
               );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }

     public function corregir($id,$rut){
          $field = array(                 
               'estado'       =>"En correción",     
               'observacion' =>$this->input->post('txt_observacion')
               );
          $this->db->where('id',$id);
          $this->db->update('sfl_solicitud', $field);
          if($this->db->affected_rows() > 0){
               return true;
          }else{
               return false;
          }
     }

     public function reporte_1($rut){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,          
		CONCAT(b.nombre, " " ,b.apellido) as "Nombre Solicitante",	          	
          a.rut_solicitante as rut,          
          b.dv as dv,
          b.direccion as direccion,
          b.departamento as departamento,
          a.tipo_solicitud    as tipo_solicitud ,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          a.estado            as estado         ,
          ');   
          /*
               a.meses_pedidos     as meses_pedidos  ,
               a.semanas_pedidas   as semanas_pedidas,
               a.medio_dia         as medio_dia      ,
               a.beneficiario      as beneficiario   ,
               a.reintegro         as reintegro      ,
               a.tiempo            as tiempo         ,
               a.hora_desde        as hora_desde     ,
               a.hora_hasta        as hora_hasta     ,
               a.horas             as horas          ,
               a.minutos           as minutos        ,
               a.desde_alcalde     as desde_alcalde  ,
               a.hasta_alcalde     as hasta_alcalde  ,
               a.accion_alcalde    as accion_alcalde ,
               a.year              as year           , 
               a.motivo            as motivo         ,
               b.rut as rut,          
               b.calidad_juridica as calidad_juridica,
               b.grado as grado,
               b.escalafon as escalafon,          
               b.cargo as cargo,
               a.rut_firma as rut_firma,
               a.firma_subrogante as firma_subrogante,
               a.rut_subrogante as rut_subrogante,
          */                      
          $this->db->having('a.rut_solicitante', $rut);                                                
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
          $query = $this->db->get('sfl_solicitud a');
          return $query;
		// return $this->db->last_query();

     }
     public function reporte_2($variable, $parametro){
          $this->db->select(' 
          a.id as id,
          a.fecha as fecha,          
		CONCAT(b.nombre, " " ,b.apellido) as "Nombre Solicitante",	          	
          a.rut_solicitante as rut,          
          b.dv as dv,
          b.direccion as direccion,
          b.departamento as departamento,
          a.tipo_solicitud    as tipo_solicitud ,
          a.dias  as dias ,
          a.fecha_inicio as fecha_inicio,
          a.fecha_termino as fecha_termino,
          a.estado            as estado         ,
          ');   
          /*
               a.meses_pedidos     as meses_pedidos  ,
               a.semanas_pedidas   as semanas_pedidas,
               a.medio_dia         as medio_dia      ,
               a.beneficiario      as beneficiario   ,
               a.reintegro         as reintegro      ,
               a.tiempo            as tiempo         ,
               a.hora_desde        as hora_desde     ,
               a.hora_hasta        as hora_hasta     ,
               a.horas             as horas          ,
               a.minutos           as minutos        ,
               a.desde_alcalde     as desde_alcalde  ,
               a.hasta_alcalde     as hasta_alcalde  ,
               a.accion_alcalde    as accion_alcalde ,
               a.year              as year           , 
               a.motivo            as motivo         ,
               b.rut as rut,          
               b.calidad_juridica as calidad_juridica,
               b.grado as grado,
               b.escalafon as escalafon,          
               b.cargo as cargo,
               a.rut_firma as rut_firma,
               a.firma_subrogante as firma_subrogante,
               a.rut_subrogante as rut_subrogante,
          */                      
          $condicion = 'b.'.$parametro;
          $this->db->having($condicion, $variable);                                                
          $this->db->join('sistemas_users b', 'a.rut_solicitante =b.rut', 'left');         
          $query = $this->db->get('sfl_solicitud a');
          return $query;
		// return $this->db->last_query();

     }
}