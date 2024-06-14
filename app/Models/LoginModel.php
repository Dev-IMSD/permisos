<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'sistemas_users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'habilitado',
        'username',
        'password',
        'pass',
        'rut',
        'dv',
        'nombre',
        'apellido',
        'sexo',
        'cargo',
        'direccion',
        'departamento',
        'telefono',
        'mail',
        'jefe',
        'director',
        'calidad_juridica',
        'grado',
        'escalafon',
        'fecha_contrato',
        'foto'
    ];
    protected $DBGroup = 'users';

    public function verificarUsuario($username, $password){ 
        $user = $this->where('username', $username)->first();
        if (!$user) {
            return ['status' => 'error', 'message' => 'Usuario no existe'];
        }
         if($user['pass'] == null){
             return ['status' => 'info', 'message' => 'Debe cambiar la clave '];
        }else{
            if (!password_verify($password, $user['pass'])) {
                return ['status' => 'error', 'message' => 'Datos incorrectos '];
             }
    
             return ['status' => 'success', 'user' => $user];
         }        
    }
    
    public function cambioClaveBd($username, $password){
        $user=$this->where('username', $username)->first();
        if($user){
            $password = password_hash($password,PASSWORD_DEFAULT);
            $this->where('username', $username)->set('pass',$password)->update();
        return ['status' => 'success', 'message'=> 'Clave modificada con exito'];
        }else{
        return ['status' => 'error', 'message' => 'Usuario no encontrado por lo que no se cambio la contraseña'];
        }
              
    }

    public function getIdByRut($rut) {
        $user = $this->where('rut', $rut)->first();
        return $user ? $user['id'] : null;
    }
}
