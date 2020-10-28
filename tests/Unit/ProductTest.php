<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testNewUserRegistration()
{
    $this->visit('/products/create')
         ->type('Taylor', 'name')
         ->type('23.45', 'price')
         ->type('8', 'quantity')
         ->type('cat1', 'category')
         ->type('subcat3', 'subcategory')         
         ->press('submit')
         ->seePageIs('/products');
}
}
