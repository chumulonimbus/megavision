<?php
namespace Modules\Authentication\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}