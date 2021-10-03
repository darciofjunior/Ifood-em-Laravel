<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error Get All Categories Categories by Tenant
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories/');
        $response->dump();

        $response->assertStatus(422);
    }

    /**
     * Error Get All Categories by Tenant
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = Category::factory()->create();

        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
