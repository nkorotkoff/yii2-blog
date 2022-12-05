<?php


namespace common\models;


use yii\db\ActiveRecord;

class Comments extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }
    public function rules()
    {
        return [
            [['name', 'text','post_id','created_at'], 'required'],
            [['text'],'string','max'=>300],
            ['name','string','max'=>150]
        ];
    }
    public function addComment($id){
        $this->post_id = $id;
        $this->created_at = date("F j, Y, g:i a");
       return self::save();
    }
}