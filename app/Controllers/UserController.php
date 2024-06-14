<?php

namespace App\Controllers;

use App\Models\SistemasUsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use ResponseTrait;
class UserController extends BaseController
{
    public function showUsers(){
        $userModel = new SistemasUsersModel(); 
        $usersJson = $userModel->getUsersJson();
        return $this->response->setContentType('application/json')->setBody($usersJson);
    }

    public function showUserByRut($rut){
        $userModel = new SistemasUsersModel(); 
        $userJson = $userModel->getUserByRutJson($rut);
        return $this->response->setContentType('application/json')->setBody($userJson);
    }

}
