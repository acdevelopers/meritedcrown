<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/pages');

        $user = User::firstOrNew(['name' => 'Anitche Chisom', 'email' => 'anitchec@gmail.com']);

        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
    }
}
