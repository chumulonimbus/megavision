<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\Api\V1\AuthModel;
use Firebase\JWT\JWT;

class AuthController extends BaseController
{
    use ResponseTrait;
    public function login()
    {
        $authModel = new AuthModel();

        $rules = [
            'email'     =>  'required|valid_email',
            'password'  =>  'required'
        ];

        if(!$this->validate($rules)){
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $authModel->getUserByEmail($email);

        if(!$user){
            return $this->failNotFound('Email tidak ditemukan');
        }

        $verifyPass = password_verify($password, $user['sp_password']);

        if(!$verifyPass){
            return $this->failUnauthorized('Password salah, coba lagi');
        }

        $key = getenv('JWT_SECRET');
        $start = time();
        $end = $start + 60;

        $payload = [
            'iat' => $start,
            'exp'   => $end,
            'data'  => [
                'id'    => $user['id'],
                'name'  => $user['sp_name'],
                'email' => $user['sp_email'],
            ]
        ];

        $accessToken = JWT::encode($payload, $key, 'HS256');
        $refreshToken = bin2hex(random_bytes(64));

        $authModel->updateToken($user['id'], $refreshToken);

        return $this->respond([
            'status'        => 'success',
            'message'       => 'Login berhasil',
            'access_token'  => $accessToken,
            'refresh_token' => $refreshToken,
            'data' => [
                'name'   => $user['sp_name'],
                'email'  => $user['sp_email'],
                'office' => $user['sp_office'],
            ]
        ]);
    }

    public function refresh()
    {
        $authModel = new AuthModel;

        $refreshToken = $this->request->getVar('refresh_token');

        if(!$refreshToken){
            return $this->failUnauthorized('Refresh token harus dikirim');
        }

        $user = $authModel->getUserByRefreshToken($refreshToken);

        if(!$user){
            return $this->failUnauthorized('Refresh token tidak valid, silahkan login ulang');
        }

        $key = getenv('JWT_SECRET');
        $start = time();
        $end = $start + 60;

        $payload = [
            'iat' => $start,
            'exp'   => $end,
            'data'  => [
                'id'    => $user['id'],
                'name'  => $user['sp_name'],
                'email' => $user['sp_email'],
            ]
        ];

        $newAccessToken = JWT::encode($payload, $key, 'HS256');

        return $this->respond([
            'status' => 'success',
            'message'=> 'Token berhasil diperbarui',
            'access_token' => $newAccessToken
        ]);
    }

    public function logout()
    {
        $authModel = new AuthModel;
        $userId = $this->request->user_id ?? null;

        if($userId){
            $authModel->removeToken($userId);
        }
        return $this->respond([
            'status' => 'success',
            'message'=> 'Logout berhasil'
        ]);
    }
}
