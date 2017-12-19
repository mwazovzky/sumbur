<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Sign in a user
     *
     * @param User user
     * @return self
     */
    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();
        $this->be($user);
        return $this;
    }

    /**
     * Login as admin.
     */
    protected function loginAdmin()
    {
        $user = factory(User::class)->create(['email' => 'admin@hamelius.ru']);
        $this->signIn($user);
    }
}
