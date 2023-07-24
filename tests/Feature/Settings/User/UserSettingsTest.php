<?php

namespace Tests\Feature\Settings\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_page_lists_a_list_of_users(): void
    {
        $john = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'permissions' => User::ROLE_ADMINISTRATOR,
        ]);
        $oliver = User::factory()->create([
            'first_name' => 'Oliver',
            'last_name' => 'Queen',
            'permissions' => User::ROLE_USER,
            'organization_id' => $john->organization_id,
        ]);

        $this->actingAs($oliver)
            ->get('/settings')
            ->assertStatus(401);

        $this->actingAs($oliver)
            ->get('/settings/users')
            ->assertStatus(401);

        $this->actingAs($john)
            ->get('/settings')
            ->assertStatus(200);

        $this->actingAs($john)
            ->get('/settings/users')
            ->assertSee('John Doe')
            ->assertSee('Oliver Queen');
    }
}
