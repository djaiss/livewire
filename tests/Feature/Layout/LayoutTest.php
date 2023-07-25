<?php

namespace Tests\Feature\Layout;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_default_layout_contains_data_it_needs_to_function(): void
    {
        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'name_for_avatar' => 'John Doe',
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertSessionHasNoErrors()
            ->assertStatus(200);

        $this->assertAuthenticated();

        $response->assertSee('John Doe');
    }
}
