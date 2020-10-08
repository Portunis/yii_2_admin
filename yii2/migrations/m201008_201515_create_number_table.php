<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%number}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m201008_201515_create_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%number}}', [
            'id' => $this->primaryKey(),
            'id_category' => $this->integer(11)->notNull(),
            'phone' => $this->string(12)->notNull(),
            'balance' => $this->integer(11)->notNull(),
            'dept' => $this->integer(11)->notNull(),
            'commit' => $this->text()->notNull(),
        ]);

        // creates index for column `id_category`
        $this->createIndex(
            '{{%idx-number-id_category}}',
            '{{%number}}',
            'id_category'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-number-id_category}}',
            '{{%number}}',
            'id_category',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-number-id_category}}',
            '{{%number}}'
        );

        // drops index for column `id_category`
        $this->dropIndex(
            '{{%idx-number-id_category}}',
            '{{%number}}'
        );

        $this->dropTable('{{%number}}');
    }
}
