<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['fullname', 'email', 'password'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'fullname' => 'required',
        'password' => 'required|min_length[10]',
        'email'    => 'required|valid_email',
    ];
    protected $validationMessages   = [
        'fullname' => 'fullname required',
        'password' => 'password required',
        'email' => 'email required',
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createAdmin($param = array())
    {
        $password = password_hash($param['password'], PASSWORD_BCRYPT);
        $data = ['fullname' => $param['fullname'], 'email' => $param['email'], 'password' => $password];
        $this->save($data);

        return true;
    }

    public function verifyAdmin($email, $password)
    {
        return $this->table($this->table)->where('email', $email)->get();
    }

    public function updateUser($id, $param = array())
    {
        $data = [];
        if (!empty($param['fullname'])) {
            $data['fullname'] = $param['fullname'];
        }
        if (!empty($param['email'])) {
            $data['email'] = $param['email'];
        }

        if (!empty($data)) {
            $this->update($id, $data);
            return true;
        }
        return false;
    }

    public function deleteAdmin($id)
    {
        $this->delete($id);
        return true;
    }
}
