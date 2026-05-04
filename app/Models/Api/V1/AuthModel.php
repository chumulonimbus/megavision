<?php

namespace App\Models\Api\V1;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'salespersons';
    protected $primaryKey = 'id';
    protected $allowedFields = ['sp_refresh_token'];

    public function getUserByEmail($email)
    {
        return $this->where('sp_email', $email)->first();
    }

    public function getUserByRefreshToken($token)
    {
        return $this->where('sp_refresh_token', $token)->first();
    }

    public function updateToken($id, $token)
    {
        return $this->update($id, ['sp_refresh_token' => $token]);
    }

    public function removeToken($id)
    {
        return $this->update($id, ['sp_refresh_token' => null]);
    }


}
