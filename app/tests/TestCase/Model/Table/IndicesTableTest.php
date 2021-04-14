<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndicesTable Test Case
 */
class IndicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndicesTable
     */
    protected $Indices;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Indices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Indices') ? [] : ['className' => IndicesTable::class];
        $this->Indices = $this->getTableLocator()->get('Indices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Indices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
