<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkTest extends TestCase
{

    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     * Success test.
     *
     * @return void
     */
    public function testSuccess()
    {
        $response = $this->json('POST', '/api', ['link' => 'https://test.com', 'slug' => 'test']);

        $response
            ->assertStatus(201);
    }

    /**
     * Fail test validation.
     *
     * @return void
     */
    public function testFailed1()
    {
        $response = $this->json('POST', '/api', ['slug' => 'test']);

        $response
            ->assertStatus(422);
    }

    /**
     * Fail test validation.
     *
     * @return void
     */
    public function testFailed2()
    {
        $response = $this->json('POST', '/api', ['link' => 'https://test.com']);

        $response
            ->assertStatus(422);
    }

    /**
     * Fail test validation.
     *
     * @return void
     */
    public function testFailed3()
    {
        $response = $this->json('POST', '/api', ['link' => '_https://test.com', 'slug' => 'test']);

        $response
            ->assertStatus(422);
    }

    /**
     * Fail test validation.
     *
     * @return void
     */
    public function testFailed4()
    {
        $this->json('POST', '/api', ['link' => 'https://test.com', 'slug' => 'test']);
        $response = $this->json('POST', '/api', ['link' => 'https://test.com', 'slug' => 'test']);

        $response
            ->assertStatus(422);
    }
}
