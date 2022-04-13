<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @param \App\Models\User|null $user
     * @return $this
     */
    public function actingAsAdmin(?User $user = null): self
    {
        return $this->actingAs($user ?? User::factory()->admin()->create());
    }
}
