<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Topup extends Migration
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
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('topup_id', true);
        $this->forge->addForeignKey('game_id', 'games', 'game_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('topup');
    }

    public function down()
    {
        //
    }
}
