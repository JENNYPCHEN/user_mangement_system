<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
 
    public function setUp(): void
	{
		parent::setUp();
		$this->seed();
    
	}
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_homepage_for_visiter()
    {
        $response = $this->get('/');
        $response->assertSee('Se Connecter');
        $response->assertSee('Inscription');
    }
    public function test_loginPage_for_visiter(){
        $response = $this->get('/se-connecter');
        $response->assertSee('Connectez-Vous');
    }
    public function test_signupPage_for_visiter(){
        $response = $this->get('/inscription');
        $response->assertSee('Créer un compte'); 
    }
    public function test_dashboard_for_visiter(){
        $response = $this->get('/tableau-de-bord');
        $response->assertRedirect('/se-connecter');
    }
    public function test_editPage_for_visiter(){
        $response = $this->get('/modifier/2');
        $response->assertStatus(404);
    }
    public function test_homepage_for_user(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertSee('se déconnecter');
        $response->assertSee('votre compte');
    }
    public function test_signupPage_for_user(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/inscription');
        $response->assertStatus(403);
    }
    public function test_loginPage_for_user(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/se-connecter');
        $response->assertRedirect('/');
    }
    public function test_dashboardPage_for_user(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/tableau-de-bord');
        $response->assertSee('Gestion de comptes');
    }
    public function test_if_registration_form_work()
    {
        $this->withoutMiddleware();
        $response = $this->post('/store', [
            'name' => 'summer',
            'email' => 'summer@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);
        $response->assertRedirect('/tableau-de-bord');
    }
}