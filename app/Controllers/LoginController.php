<?php

namespace App\Controllers;

use App\Controllers\view;
use App\Models\LoginModel;
use App\Models\PermisosModel;
use App\Models\SolicitudModel;
use CodeIgniter\HTTP\ResponseInterface;
use Permisos;
use ResponseTrait;


class LoginController extends BaseController
{

    public function index()
    {   //
        //Se destruye la sesión  
        session()->destroy();
        return view('login');
    }

    public function logout()
    {
        //Se destruye la sesión
        session()->destroy();
        return redirect()->to('/login');
    }

    public function autentificar()
    {
        // Verifica si la solicitud es de tipo POST
        if ($this->request->getMethod() === 'post') {
            // Obtiene el username y password del formulario
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $modelo = new LoginModel();

            // Verifica el usuario con el método verificarUsuario
            $user = $modelo->verificarUsuario($username, $password);


            // Si el usuario se verifica correctamente
            if ($user['status'] === 'success') {
                // Obtiene el ID de usuario
                $usuarioId = $user['user']['id'];
                $modelo2 = new PermisosModel();

                // Obtiene el nivel de acceso del usuario por su ID
                $nivelById = $modelo2->obtenerNivelAcceso($usuarioId);

                // Verifica el nivel de acceso
                if ($nivelById == 4) {

                    $this->session;
                    $dataSession = [
                        'userId'    => $user['user']['id'],
                        'username'  => $user['user']['username'],
                        'isLoggedIn' => true,
                        'nivel'     => $nivelById,
                        'nombre'    => $user['user']['nombre'] . " " . $user['user']['apellido'],
                        'direccion' => $user['user']['direccion'],
                        'depto'     => $user['user']['departamento'],
                        'rut'       => $user['user']['rut'],
                        
                    ];

                    $this->session->set($dataSession);
                    $this->session->setFlashdata('msg', 'Bienvenido al sistema ' . $dataSession['nombre']);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Entrando, espere unos segundos', 'nivel' => $nivelById]);

                    //     
                } else if ($nivelById == 3) {

                    $this->session;
                    $dataSession = [
                        'userId' => $user['user']['id'],
                        'username' => $user['user']['username'],
                        'isLoggedIn' => true,
                        'nivel' => $nivelById,
                        'nombre' => $user['user']['nombre'] . " " . $user['user']['apellido'],
                        'direccion' => $user['user']['direccion'],
                        'depto' => $user['user']['departamento'],
                        'rut'       => $user['user']['rut'],
                        
                    ];

                    $this->session->set($dataSession);
                    $this->session->setFlashdata('msg', 'Bienvenido al sistema ' . $dataSession['nombre']);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Entrando, espere unos segundos', 'nivel' => $nivelById]);
                }
                return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes Permisos']);
            }
            return $this->response->setJSON($user);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request method' . $this->request->getMethod()]);
    }

    public function cambioClave()
    {
        return view('cambioClave');
    }

    public function actualizacionClave()
    {   // Verifica si la solicitud es de tipo POST
        if ($this->request->getMethod() === 'post') {
            // Obtiene el username y password del formulario
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $modelo = new LoginModel();
            // Se cambia la contraseña con el método cambioClaveBd
            $user = $modelo->cambioClaveBd($username, $password);
            if ($user) {
                return $this->response->setJSON($user);
            }
            return $this->response->setJSON(['status' => 'error', 'message' => 'No funciona']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'No esta recibiendo']);
    }

    public function permisos($rut)
    {
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes Permisos']);
        } else if ($this->session->get('nivel' == 4)) {
            $sistema = "SolicitudCompra";
            $userModel = new LoginModel();
            $permisos = new PermisosModel();
            $userId = $userModel->getIdByRut($rut);
            $userJson = $permisos->getPermisosById($userId, $sistema);
            return $this->response->setContentType('application/json')->setBody($userJson);
        }
    }

    
    public function showSolicitud()
    {

        try {
            $solicitudModel = new SolicitudModel();
            $solicitudJson = $solicitudModel->getSolictudesJson();
            return $this->response->setContentType('application/json')->setBody($solicitudJson);
        } catch (\Exception $e) {
            return $this->response->setContentType('application/json')->setBody(json_encode(['error' => $e->getMessage()]));
        }
    }
}
