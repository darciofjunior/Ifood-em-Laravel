<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error Get All Tables by Tenant
     *
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/v1/tables/');
        $response->dump();

        $response->assertStatus(422);
    }

    /**
     * Error Get All Tables by Tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Table by Tenant
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $table = 'fake_value';

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $table = Table::factory()->create();

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
