<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "enclosure".
 *
 * @property int $id
 * @property int $episode_id
 * @property int $length
 * @property string $type
 * @property string $url
 * @property int $created_at
 * @property int $updated_at
 * @property Episode $episode
 */
class Enclosure extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%enclosure}}';
    }

    public function behaviors(): array
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['episode_id', 'length', 'type', 'url'], 'required'],
            [['episode_id', 'length', 'created_at', 'updated_at'], 'integer'],
            [['type', 'url'], 'string', 'max' => 255],
            [['episode_id'], 'exist', 'skipOnError' => true, 'targetClass' => Episode::class, 'targetAttribute' => ['episode_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'episode_id' => 'Episode ID',
            'length' => 'Length',
            'type' => 'Type',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Episode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEpisode()
    {
        return $this->hasOne(Episode::class, ['id' => 'episode_id']);
    }
}
