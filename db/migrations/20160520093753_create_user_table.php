<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     */
    public function change()
    {
        $table = $this->table('user');
        $table->addColumn('uuid', 'uuid')
              ->addColumn('first_name', 'string', array('limit' => 100))
              ->addColumn('last_name', 'string', array('limit' => 100))
              ->addColumn('email_address', 'string', array('limit' => 255))
              ->addColumn('created', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
              ->addColumn('updated', 'timestamp', array('null' => true, 'default' => null))
              ->addIndex(array('uuid'), array('unique' => true))
              ->addIndex(array('email_address'), array('unique' => true))
              ->create();
    }
}
