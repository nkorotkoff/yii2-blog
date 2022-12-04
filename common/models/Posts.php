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
    public $HashtagsShow;
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
            [['title', 'category_id', 'text', 'created_at', 'user_id'], 'required'],
            [[ 'created_at', 'user_id', 'views', 'likes'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['img'],'image','skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            ['category_id','safe']
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
    public function upload()
    {

        $name = Yii::$app->security->generateRandomString(8) ;
        $this->img->saveAs(Yii::getAlias('@uploadedfilesdir/') . $name. '.' . $this->img->extension);
        $this->img = $name. '.' . $this->img->extension;
    }
    public function savePost(){
       $this->upload();
        $this->category_id = Category::findOne($this->category_id)->id;
        $this->user_id = \Yii::$app->user->getId();
        $this->created_at = date("Ymd");
        return self::save();
    }
    public function getCategories(){
        return $this->hasOne(Category::class,['id'=>'category_id']);
    }
    public function getHashtags(){
        return $this->hasMany(Hashtags::class,['id'=>'hashtag_id'])->viaTable('hashtag_post',['post_id'=>'id']);
    }

}
