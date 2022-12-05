<?php

use yii\db\Migration;

/**
 * Class m221203_195801_comments
 */
class m221203_195801_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
//    public function safeDown()
//    {
//        echo "m221203_195801_comments cannot be reverted.\n";
//
//        return false;
//    }


    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text'=>$this->text()->notNull(),
            'post_id' => $this->integer()->notNull(),
            'created_at'=>$this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('comments');
    }

}
