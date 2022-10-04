<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%episode}}`.
 */
class m221001_030226_create_episode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%episode}}', [
            'id' => $this->primaryKey(),
            'show_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'link' => $this->string()->notNull()->unique(),
            'guid' => $this->string()->notNull(),
            'pub_date' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_episode_podcast_id', '{{%episode}}', 'show_id', '{{%show}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%episode}}');
    }
}
