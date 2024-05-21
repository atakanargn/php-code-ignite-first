<?php

namespace App\Models;

use CodeIgniter\Model;

class Demirbas extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'demirbas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description', 'status', 'price'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required',
        'status'    => 'required',
        'price' => 'required',
    ];
    protected $validationMessages   = [
        'name' => 'name required',
        'status' => 'status required',
        'price' => 'price required',
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

    public function createDemirbas($param = array())
    {
        $data = ['name' => $param['name'], 'description' => $param['description'], 'status' => $param['status'],'price' => $param['price']];
        $this->save($data);

        return true;
    }

    public function updateDemirbas($id, $param = array())
    {
        $data = [];
        if (!empty($param['status'])) {
            $data['status'] = $param['status'];
            $data['description']=$param['description']==null?'':$param['description'];
        }
        if (!empty($data)) {
            $this->update($id, $data);
            return true;
        }
        return false;
    }

    public function deleteDemirbas($id)
    {
        $this->delete($id);
        return true;
    }
}
