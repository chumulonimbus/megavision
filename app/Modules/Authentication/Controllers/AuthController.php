<?php

namespace Modules\Authentication\Controllers;

use App\Controllers\BaseController;
use Modules\Authentication\Models\AuthModel;

class AuthController extends BaseController 
{
    public function index()
    {
        if(session()->get('isLoggedIn')){
            return redirect()->to('/dashboard');
        }
        return view('Modules\Authentication\Views\login');
    }

    public function process()
    {
        $session = session();
        $authModel = new AuthModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $authModel->getUserByEmail($email);

        if($user){
            $verifyPass = password_verify($password, $user['password']);

            if($verifyPass){
                $dataSession = [
                    'userId' => $user['id'],
                    'userName' => $user['name'],
                    'userEmail' => $user['email'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($dataSession);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan');
            return redirect()->to('/login');
        }
    }
    
    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}