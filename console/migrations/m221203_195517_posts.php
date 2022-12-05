<?php

use yii\db\Migration;

/**
 * Class m221203_195517_posts
 */
class m221203_195517_posts extends Migration
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
//        echo "m221203_195517_posts cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'img'=>$this->string()->notNull(),
            'category_id'=>$this->integer()->notNull(),
            'text'=>$this->text()->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'views'=>$this->integer(),
            'likes'=>$this->integer()->defaultValue(0)
        ]);
    }

    public function down()
    {
        $this->dropTable('posts');
    }

}
