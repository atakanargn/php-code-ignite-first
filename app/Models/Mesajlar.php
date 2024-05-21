<?php

namespace App\Models;

use CodeIgniter\Model;

class Mesajlar extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mesajlar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['content', 'status','reply', 'created_by'];

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

    public function createMesaj($param = array())
    {
        $data = ['content' => $param['content'], 'status' => '0','reply' => '', 'created_by' => $param['created_by']];
        $this->save($data);
        return true;
    }

    public function updateMesaj($id, $param = array())
    {
        $data = [];
        if (!empty($param['reply'])) {
            $data['reply']=$param['reply'];
        }
        if (!empty($data)) {
            $this->update($id, $data);
            return true;
        }
        return false;
    }

    public function readMesaj($id){
        $this->update($id, ['status'=> '1']);
    }
}
