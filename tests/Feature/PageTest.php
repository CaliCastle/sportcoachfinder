<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    /** @test */
    public function home_page_should_work()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
    }
}
