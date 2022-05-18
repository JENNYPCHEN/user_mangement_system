<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as FakerFactory;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Symfony\Component\HttpFoundation\Session\Session;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
 
    private $seed;
    public function setUp(): void
	{
		parent::setUp();
		
    
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
        $response->assertViewIs('login');
    }
    public function test_signupPage_for_visiter(){
        $response = $this->get('/inscription');
        $response->assertViewIs('signup');
    }
    public function test_dashboard_for_visiter(){
        $response = $this->get('/tableau-de-bord');
        $response->assertRedirect('/se-connecter');
    }
    public function test_editPage_for_visiter(){
        $response = $this->get('/modifier/2');
        $response->assertStatus(403);
    }
    public function test_delete_for_visiter(){
        $this->withoutMiddleware();
        $response = $this->delete('/corbeille/2');
        $response->assertStatus(500);
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
        $response->assertSee($user->name);
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
    public function test_homepage_for_admin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get('/');
        $response->assertSee('créer un compte');
    }
    public function test_loginPage_for_admin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get('/se-connecter');
        $response->assertRedirect('/');
    }
    public function test_dashboardPage_for_admin()
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get('/tableau-de-bord');
        $response->assertViewIs('dashboard');
        $response->assertDontSee($admin->email);
    }
    public function test_delete_for_admin(){
        $this->withoutMiddleware();
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->delete('/corbeille/2');
        $response->assertRedirect('/tableau-de-bord');

    }
    public function test_delete_admin_from_admin (){

        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->delete('/corbeille/1');
        $response->assertStatus(419);
    }
    
    public function test_user_delete_other_user (){
    
        $user = User::factory()->create(['id' => 4]);
        $response = $this->actingAs($user)->delete('/corbeille/2');
        $response->assertStatus(419);
    }

    public function test_user_not_show_permenent_delete_button (){

        $user = User::factory()->create(['id'=>4]);
        $response = $this->actingAs($user)->get('/tableau-de-bord');
        $response->assertDontSee('supprimer définitivement');

    }
    
}