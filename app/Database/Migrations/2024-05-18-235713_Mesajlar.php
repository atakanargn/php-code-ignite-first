<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mesajlar extends Migration
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
            'content' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'TEXT',
            ],
            'reply' => [
                'type' => 'TEXT',
            ],
            'created_by' => [
                'type' => 'INT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mesajlar');
    }

    public function down()
    {
        $this->forge->dropTable('mesajlar');
    }
}
