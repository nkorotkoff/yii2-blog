<?php

use yii\db\Migration;

/**
 * Class m221203_195628_hashtag_post
 */
class m221203_195628_hashtag_post extends Migration
{
    /**
     * {@inheritdoc}
     */
//    public function safeUp()
//    {
//
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function safeDown()
//    {
//
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('hashtag_post', [
            'id' => $this->primaryKey(),
            'hashtag_id' => $this->integer()->notNull(),
            'post_id'=>$this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('hashtag_post');
    }

}
