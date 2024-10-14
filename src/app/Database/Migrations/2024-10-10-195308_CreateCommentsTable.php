<?php
use CodeIgniter\Database\Migration;

class CreateCommentsTable extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'text' => [
                'type' => 'TEXT',
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('comments');
    }

    public function down() {
        $this->forge->dropTable('comments');
    }
}