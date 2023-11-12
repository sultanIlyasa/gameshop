<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'transaction_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'games_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'gameuser_id' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'game_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'total_payment' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->addKey('transaction_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('games_id', 'games', 'game_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        //
    }
}
