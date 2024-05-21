<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 30,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'email' => [
                'type' => 'TEXT',
            ],
            'password' => [
                'type' => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admins');
        
        // Tablo oluşturulduktan sonra kayıt ekleme
        $password = password_hash('1234', PASSWORD_BCRYPT);
        $data = [
            'fullname' => 'Sistem Yöneticisi',
            'email' => 'admin@panel.com',
            'password' => $password,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('admins');
        $builder->insert($data);
    }

    public function down()
    {
        //
        $this->forge->dropTable('admins');
    }
}

