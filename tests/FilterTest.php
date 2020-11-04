<?php

use App\Filters\UsersFilter;
use Illuminate\Http\Client\Request;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FilterTest extends TestCase
{
    /** @test */
    public function assert_provider()
    {   
    
        $response = $this->get('/api/v1/users?provider=DataProviderX');

        $response->seeJson([
            'provider' => 'DataProviderX',
         ]);

        $response = $this->get('/api/v1/users?provider=DataProviderY');
        $response->seeJson([
            'provider' => 'DataProviderY',
         ]);
    }

    /** @test */
    public function assert_status_code()
    {   
    
        $response = $this->get('/api/v1/users?statusCode=authorised');

        $response->assertResponseStatus(200);
        $response->seeJson([
            'status' => 100,
         ]);


        $response = $this->get('/api/v1/users?statusCode=decline');

        $response->assertResponseStatus(200);
        $response->seeJson([
            'status' => 200,
        ]);


        $response = $this->get('/api/v1/users?statusCode=refunded');

        $response->assertResponseStatus(200);
        $response->seeJson([
            'status' => 300,
        ]);

    }

    /** @test */
    public function assert_balance()
    {
        $response = $this->get('/api/v1/users?balanceMin=100&balanceMax=300');

        $response->assertResponseStatus(200);
        $response->dontSeeJson([
            'blanace' => 400,
        ]);

    }


    /** @test */
    public function assert_currency()
    {
        $response = $this->get('/api/v1/users?currency=USD');
        
        $response->assertResponseStatus(200);
        $response->dontSeeJson([
            'currency' => 'EUR',
        ]);
        $response->seeJson([
            'currency' => 'USD',
        ]);
    }
    
    /** @test */
    public function assert_all_users()
    {
        $response = $this->get('/api/v1/users');
        
        $response->assertResponseStatus(200);
    }
}
