<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbGames extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'game_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'game_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                null => true,
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
        $this->forge->addKey('game_id', true);
        $this->forge->addUniqueKey('title');
        $this->forge->createTable('games');
    }

    public function down()
    {
        //
        $this->forge->dropTable('games');
    }
}
