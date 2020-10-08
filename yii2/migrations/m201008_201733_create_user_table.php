<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%number}}`
 * - `{{%role}}`
 * - `{{%image}}`
 */
class m201008_201733_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'id_number' => $this->integer(11),
            'id_role' => $this->integer(11)->notNull(),
            'id_image' => $this->integer(11),
            'full_name' => $this->string(150)->notNull(),
            'username' => $this->string(150)->notNull()->unique(),
            'email' => $this->string(140)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
        ]);

        // creates index for column `id_number`
        $this->createIndex(
            '{{%idx-user-id_number}}',
            '{{%user}}',
            'id_number'
        );

        // add foreign key for table `{{%number}}`
        $this->addForeignKey(
            '{{%fk-user-id_number}}',
            '{{%user}}',
            'id_number',
            '{{%number}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_role`
        $this->createIndex(
            '{{%idx-user-id_role}}',
            '{{%user}}',
            'id_role'
        );

        // add foreign key for table `{{%role}}`
        $this->addForeignKey(
            '{{%fk-user-id_role}}',
            '{{%user}}',
            'id_role',
            '{{%role}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_image`
        $this->createIndex(
            '{{%idx-user-id_image}}',
            '{{%user}}',
            'id_image'
        );

        // add foreign key for table `{{%image}}`
        $this->addForeignKey(
            '{{%fk-user-id_image}}',
            '{{%user}}',
            'id_image',
            '{{%image}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%number}}`
        $this->dropForeignKey(
            '{{%fk-user-id_number}}',
            '{{%user}}'
        );

        // drops index for column `id_number`
        $this->dropIndex(
            '{{%idx-user-id_number}}',
            '{{%user}}'
        );

        // drops foreign key for table `{{%role}}`
        $this->dropForeignKey(
            '{{%fk-user-id_role}}',
            '{{%user}}'
        );

        // drops index for column `id_role`
        $this->dropIndex(
            '{{%idx-user-id_role}}',
            '{{%user}}'
        );

        // drops foreign key for table `{{%image}}`
        $this->dropForeignKey(
            '{{%fk-user-id_image}}',
            '{{%user}}'
        );

        // drops index for column `id_image`
        $this->dropIndex(
            '{{%idx-user-id_image}}',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
