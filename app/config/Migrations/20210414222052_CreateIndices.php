<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateIndices extends AbstractMigration
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
        $this->table('indices', ['signed' => false])
            ->addColumn('tipo', 'string', ['limit' => 20, 'null' => false])
            ->addColumn('data', 'date', ['null' => false])
            ->addColumn('indice', 'decimal', ['precision' => 14, 'scale' => 6])
            ->create();
    }
}
