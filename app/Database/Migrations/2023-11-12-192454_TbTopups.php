<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTopups extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'topup_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'game_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'topup_title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('topup_id', true);
        $this->forge->addForeignKey('game_id', 'games', 'game_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('topups');
    }

    public function down()
    {
        //
        $this->forge->dropTable('topups');
    }
}
