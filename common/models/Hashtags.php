<?php


namespace common\models;


use yii\db\ActiveRecord;

class Hashtags extends ActiveRecord
{
    public static function tableName()
    {
        return 'hashtags';
    }
    public function getPosts(){
        return $this->hasMany(Posts::class,['id'=>'post_id'])->viaTable('hashtag_post',['hashtag_id'=>'id']);
    }
}