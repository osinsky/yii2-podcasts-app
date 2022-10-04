<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%enclosure}}`.
 */
class m221001_055905_create_enclosure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%enclosure}}', [
            'id' => $this->primaryKey(),
            'episode_id' => $this->integer()->notNull(),
            'length' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_enclosure_episode_id', '{{%enclosure}}', 'episode_id', '{{%episode}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%enclosure}}');
    }
}
