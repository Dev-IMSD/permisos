<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisosModel extends Model
{
    protected $table = 'sistemas_sistemasxusuario';
    protected $primaryKey = 'id_permiso';
    protected $allowedFields = [
        'id_sistema',
        'id_usuario',
        'nivel_acceso',
        'tipoadmin',
        'permiso_adicional',
        'estado'
    ];
 
    protected $DBGroup = 'users';
    public function getPermisosById($id_usuario,$sistema)
    {
        try {            
            $user = $this->where('id_usuario', $id_usuario)->where('id_sistema', $sistema)->first();
            if ($user) {
                return json_encode($user);
            } else {
                return json_encode(['error' => 'User not found']);
            }
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
 
    public function obtenerId($username){
        $user = $this->where('username', $username)->first();
        if ($user)
            $usuarioId= $user['id_usuario'];
            return ['id_usuario'=> $usuarioId];
    }

}
