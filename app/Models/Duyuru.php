<?php

namespace App\Models;

use CodeIgniter\Model;

class Duyuru extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'duyuru';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['content', 'status', 'created_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'content' => 'required',
        'status'    => 'required',
        'created_by' => 'required',
    ];
    protected $validationMessages   = [
        'content' => 'content required',
        'status' => 'status required',
        'created_by' => 'created_by required',
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

    public function createDuyuru($param = array())
    {
        $data = ['content' => $param['content'], 'status' => $param['status'], 'created_by' => $param['created_by']];
        $this->save($data);
        return true;
    }

    public function updateDuyuru($id, $param = array())
    {
        $data = [];
        if (!empty($param['content'])) {
            $data['content'] = $param['content'];
        }
        if (!empty($data)) {
            $this->update($id, $data);
            return true;
        }
        return false;
    }

    public function deleteDuyuru($id)
    {
        $this->delete($id);
        return true;
    }
}
