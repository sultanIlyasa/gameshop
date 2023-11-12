<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTransactions extends Migration
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
                'unsigned' => true,
            ],
            'game_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
            'payment_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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
        $this->forge->addForeignKey('game_id', 'games', 'game_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        //
        $this->forge->dropTable('transactions');
    }
}
