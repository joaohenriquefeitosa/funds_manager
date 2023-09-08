<?php

use Tests\TestCase;
use App\Services\Fund\FundServiceInterface;
use App\Models\Fund;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FundControllerTest extends TestCase
{
    // use RefreshDatabase;

    protected $fundService;

    public function setUp(): void
    {
        parent::setUp();
        $this->fundService = $this->app->make(FundServiceInterface::class);
    }

    public function testIndex()
    {
        $response = $this->get(route('funds.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('funds.show', 2));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "id", "name", "start_year"
        ]);
    }

    public function testStore()
    {
        $data = [
            "name" => "Test",
            "start_year" => "1992",
            "manager" => "Paul and John",
            "alias" => ["Alias1", "Alias2", "Alias3"],
            "companies" => ["Cp1", "Cp2", "Cp3"]
        ];
        $response = $this->post(route('funds.store'), $data);
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $data = [
            "name" => "Test",
            "start_year" => "1992",
            "manager" => "Paul and John",
            "alias" => ["Alias1", "Alias2", "Alias3"],
            "companies" => ["Cp1", "Cp2", "Cp3"]
        ];

        $response = $this->put(route('funds.update', 1), $data);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('funds.destroy', 1));
        $response->assertStatus(204);
    }
}
