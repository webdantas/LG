<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Dashboard deve abrir corretamente.
     */
    public function test_dashboard_is_accessible()
    {
        $this->seed();

        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('Dashboard Produção')
            ->assertSee('Geladeira')
            ->assertSee('TV');
    }

    /**
     * Deve filtrar por linha de produção.
     */
    public function test_dashboard_filters_product_line()
    {
        $this->seed();

        $response = $this->get('/?line=TV');

        $response
            ->assertStatus(200)
            ->assertSee('TV')
            ->assertDontSee('Geladeira')
            ->assertDontSee('Máquina de Lavar')
            ->assertDontSee('Ar-Condicionado');
    }
}