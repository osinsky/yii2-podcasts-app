<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "download".
 *
 * @property int $id
 * @property string $link
 * @property string $filename
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Download extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%download}}';
    }

    public static function dirName(): string
    {
        return '/runtime/files/';
    }

    public function behaviors(): array
    {
        return [TimestampBehavior::class];
    }

    public function rules(): array
    {
        return [
            [['link', 'filename', 'status'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['link', 'filename'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'filename' => 'Filename',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
