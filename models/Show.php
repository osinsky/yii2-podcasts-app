<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "show".
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string|null $image
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property Episode[] $episodes
 */
class Show extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%show}}';
    }

    /** @return array<mixed> */
    public function behaviors(): array
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'link'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'link', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
            'image' => 'Image',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Episodes]].
     */
    public function getEpisodes(): ActiveQuery
    {
        return $this->hasMany(Episode::class, ['show_id' => 'id']);
    }
}
