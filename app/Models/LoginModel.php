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

    public function verificarUsuario($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if (!$user) {
            return ['status' => 'error', 'message' => 'Usuario no existe'];
        }
        if ($user['pass'] == null) {
            return ['status' => 'info', 'message' => 'Debe cambiar la clave '];
        } else {
            if (!password_verify($password, $user['pass'])) {
                return ['status' => 'error', 'message' => 'Datos incorrectos '];
            }
            return ['status' => 'success', 'user' => $user]; //'usuarioId'=> $usuarioId
        }
    }

    private function validarClave($password)
    {
        if (strlen($password) < 8) {
            return ['status' => 'error', 'message' => 'La contraseña debe tener al menos 8 caracteres'];
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return ['status' => 'error', 'message' => 'La contraseña debe contener al menos una letra mayúscula'];
        }
        if (!preg_match('/[a-z]/', $password)) {
            return ['status' => 'error', 'message' => 'La contraseña debe contener al menos una letra minúscula'];
        }
        if (!preg_match('/[0-9]/', $password)) {
            return ['status' => 'error', 'message' => 'La contraseña debe contener al menos un número'];
        }
        if (!preg_match('/[\W_]/', $password)) {
            return ['status' => 'error', 'message' => 'La contraseña debe contener al menos un carácter especial'];
        }
        return ['status' => 'success'];
    }


    public function cambioClaveBd($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user) {
            $validation = $this->validarClave($password);
            if ($validation['status'] !== 'success') {
                return $validation;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->where('username', $username)->set('pass', $password)->update();
            return ['status' => 'success', 'message' => 'Clave modificada con exito'];
        } else {
            return ['status' => 'error', 'message' => 'Usuario no encontrado por lo que no se cambio la contraseña'];
        }
    }

    public function getIdByRut($rut)
    {
        $user = $this->where('rut', $rut)->first();
        return $user ? $user['id'] : null;
    }

    public function getUserData($rut)
    {
        $userModel = new UserModel();
        $userData = $userModel->datos_user($rut);

        if ($userData) {
            // Usuario encontrado, hacer algo con los datos...
            print_r($userData);
        } else {
            // Usuario no encontrado, manejar el caso...
            echo "Usuario no encontrado";
        }
    }


    // Envia los funcionarios de la direccion 
    public function getFuncionariosDireccion($direccion, $rutSolicitante)
    {
        $encrypter= service('encrypter');

        $user = $this->where('direccion',$encrypter->decrypt($direccion))
        //busca todos menos el rut que se entrega
        ->where('rut !=', $encrypter->decrypt($rutSolicitante))
        ->orderby('nombre','asc')
        ->get()
        ->getResultArray();
        return $user ?? 'no hay subrogantes';
    }
}
