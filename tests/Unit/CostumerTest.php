<?php

namespace Tests\Unit;
use App;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $costumes = factory(App\Customer::class,50)->make();



        return $this->assertTrue($costumes->count() > 0);
    }
}
