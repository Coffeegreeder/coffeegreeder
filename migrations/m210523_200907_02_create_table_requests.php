<?php

use yii\db\Migration;

class m210523_200907_02_create_table_requests extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%requests}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'is_solved' => $this->boolean()->notNull()->defaultValue('0'),
                'reason' => $this->string(),
                'description' => $this->text()->notNull(),
                'img_before' => $this->string()->notNull(),
                'img_after' => $this->string(),
                'category_id' => $this->integer()->notNull()->defaultValue('1'),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%requests}}');
    }
}
