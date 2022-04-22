<?php

namespace Tests\Feature;

use App\Enums\Language;
use Tests\TestCase;

class LanguageSwitcherTest extends TestCase
{
    /** @test */
    public function it_changes_language_to_spanish(): void
    {
        $this
            ->get('/')
            ->assertSee('Log in')
            ->assertSessionMissing('locale');

        $this
            ->get(route('lang', Language::ES->value))
            ->assertRedirect()
            ->assertSessionHas('locale', Language::ES->value);

        $this
            ->get('/')
            ->assertSee('Iniciar sesión');
    }

    /** @test */
    public function it_allows_only_declared_enum_languages(): void
    {
        $this
            ->get('/')
            ->assertSee('Log in')
            ->assertSessionMissing('locale');

        $this
            ->get(route('lang', 'fr'))
            ->assertRedirect()
            ->assertSessionMissing('locale');

        $this
            ->get('/')
            ->assertSee('Log in');
    }
}
