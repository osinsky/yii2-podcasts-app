<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "episode".
 *
 * @property int $id
 * @property int $show_id
 * @property string $title
 * @property string|null $description
 * @property string $link
 * @property string $guid
 * @property string $pub_date
 * @property int $created_at
 * @property int $updated_at
 * @property Enclosure[] $enclosures
 * @property Show $show
 */
class Episode extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'episode';
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
            [['show_id', 'title', 'link', 'guid', 'pub_date'], 'required'],
            [['show_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['title', 'link', 'guid', 'pub_date'], 'string', 'max' => 255],
            [['link'], 'unique'],
            [['show_id'], 'exist', 'skipOnError' => true, 'targetClass' => Show::class, 'targetAttribute' => ['show_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_id' => 'Show ID',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'guid' => 'Guid',
            'pub_date' => 'Pub Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Enclosures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnclosures()
    {
        return $this->hasMany(Enclosure::class, ['episode_id' => 'id']);
    }

    /**
     * Gets query for [[Show]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShow()
    {
        return $this->hasOne(Show::class, ['id' => 'show_id']);
    }
}
