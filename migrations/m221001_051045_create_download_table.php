<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%download}}`.
 */
class m221001_051045_create_download_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%download}}', [
            'id' => $this->primaryKey(),
            'link' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%download}}');
    }
}
