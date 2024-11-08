<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $adminUser;

    protected function setUp(): void{
        parent::setUp();

        $this->seed();

        $this->adminUser = User::where('name', 'Jeysson Manuel Sánchez Rodríguez')->first();
    }
}
