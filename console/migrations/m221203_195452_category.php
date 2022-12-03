<?php

use yii\db\Migration;

/**
 * Class m221203_195452_category
 */
class m221203_195452_category extends Migration
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
//        echo "m221203_195452_category cannot be reverted.\n";
//
//        return false;
//    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),

        ]);

    }

    public function down()
    {
        $this->dropTable('category');
    }

}
