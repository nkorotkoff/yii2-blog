<?php


namespace common\models;


class Comments
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
}