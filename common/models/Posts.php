<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property int $category_id
 * @property string $text
 * @property int $created_at
 * @property int $user_id
 * @property int|null $views
 * @property int|null $likes
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'img', 'category_id', 'text', 'created_at', 'user_id'], 'required'],
            [['category_id', 'created_at', 'user_id', 'views', 'likes'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['img'],'image','skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img' => 'Img',
            'category_id' => 'Category ID',
            'text' => 'Text',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'views' => 'Views',
            'likes' => 'Likes',
        ];
    }
}
