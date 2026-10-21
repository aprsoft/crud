<?php

namespace Tests\Feature;

use App\Livewire\UserTable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_users_index(): void
    {
        $this->get(route('users.index'))
            ->assertRedirect('/');
    }

    public function test_authenticated_user_can_see_the_users_table(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertOk()
            ->assertViewIs('users.index')
            ->assertSee('Listado de usuarios')
            ->assertSeeLivewire(UserTable::class);
    }
}
