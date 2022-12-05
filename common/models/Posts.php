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
        if($this->img !== '' && $this->img !== null){
            $this->upload();
        }else{
            $this->img = self::findOne($this->id)->img;
//            var_dump($this->img);
        }



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
    public function getUser(){
        return $this->hasOne(User::class,['id'=>'user_id']);
    }
    public function getComments(){
        return $this->hasMany(Comments::class,['post_id'=>'id']);
    }
    public function incrementPost(){
        $this->views = $this->views +1;
        $this->save();
    }

   public function subword($l = 700)
    {
        $content = $this->text;
        if(strlen($content) > $l)
        {

            $content = str_split($content);
            while(ord($content[$l]) != 32)
            {
                --$l;
            }

            $content = array_slice($content,0,$l);
            return implode("",$content)."...";
        }
        return $this->text;


    }
    public function checkLike(){
        $session = Yii::$app->session;
        $session->open();
//      $alo =  $session->get('vcbcv');
//        var_dump($alo);

            if($session->get($this->title)){
                $session->close();
                return 'fa-solid';
            }

        $session->close();
        return 'fa-regular';
    }

}
