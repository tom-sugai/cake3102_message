<?php
use Migrations\AbstractMigration;

class AddRoleToUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('role', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->update();
    }
}
