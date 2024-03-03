<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class Userindex_Test extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_admin_guest_user_can_not_login_index(): void
    {
        $response = $this->get( '/admin/users' );
        $this->assertGuest();  
    }

    public function test_admin_user_can_not_login_index(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertGuest();
    }

    public function test_admin_admins_user_can_login_index(): void
    {
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->get('/admin/users');
        $this->assertStatus(200);
    }
}

class Usershow_Test extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_admin_guest_user_can_not_login_show(): void
    {
        $response = $this->get( '/admin/show' );
        $this->assertGuest();  
    }

    public function test_admin_user_can_not_login_show(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/show');
        $response->assertGuest();
    }

    public function test_admin_admins_user_can_login_show(): void
    {
        $admin = new Admin();
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('nagoyameshi');
        $admin->save();

        $response = $this->get('/admin/show');
        $this->assertStatus(200);
    }
}
