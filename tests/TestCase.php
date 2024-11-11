<?php

namespace Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Filament\Facades\Filament;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    
    public $adminUser;

    protected function setUp(): void{
        parent::setUp();

        $this->seed();

        $this->adminUser = User::where('email', 'jeysson_s.r@hotmail.com')->first();

    }
}
