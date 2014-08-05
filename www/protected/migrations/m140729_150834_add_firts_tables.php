<?php

class m140729_150834_add_firts_tables extends CDbMigration
{
	public function up()
	{
            // Добавляем таблицу событий
            $this->createTable('yii_events', array(
                'id' => 'pk',
                'date' => 'DATETIME NOT NULL',
                'title' => 'VARCHAR(255) NOT NULL',
                'description' => 'text',
                'date_added' => 'DATETIME NOT NULL',
            ), 'ENGINE=MyISAM CHARSET=utf8');
            
            // Добавляем таблицу для пользователей
            $this->createTable('yii_users', array(
                'id' => 'pk',
                'login' => 'VARCHAR(128) NOT NULL',
                'password' => 'VARCHAR(255) NOT NULL',
                'role_id' => 'INT(11) NOT NULL',
            ), 'ENGINE=MyISAM CHARSET=utf8');
            
            // Добавляем пользователя "начальник"
            $this->insert('yii_users', array(
                'login' => 'admin',
                'password' => CPasswordHelper::hashPassword('admin'),
                'role_id'=> '1'
            ));
            
            // Добавляем пользователя "cотрудник"
            $this->insert('yii_users', array(
                'login' => 'user',
                'password' => CPasswordHelper::hashPassword('user'),
                'role_id'=> '2'
            ));
            
            // Добавляем таблицу доступов для пользователей
            $this->createTable('yii_users_role', array(
                'id' => 'pk',
                'role_id' => 'INT(11) NOT NULL',
                'role_desc' => 'VARCHAR(64) NOT NULL',
            ), 'ENGINE=MyISAM CHARSET=utf8');
            
            // Добавляем пользователя "начальник"
            $this->insert('yii_users_role', array(
                'role_id' => '1',
                'role_desc' => 'Начальник'
            ));
            
            // Добавляем пользователя "начальник"
            $this->insert('yii_users_role', array(
                'role_id' => '2',
                'role_desc' => 'Сотрудник'
            ));
            
	}

	public function down()
	{
            // Удаляем таблицу событий
            $this->dropTable('yii_events');
            
            // Удаляем таблицу пользователей
            $this->dropTable('yii_users');
            
            // Удаляем таблицу ролей
            $this->dropTable('yii_users_role');
	}
}