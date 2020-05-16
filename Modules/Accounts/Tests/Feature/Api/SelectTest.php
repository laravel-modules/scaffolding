<?php

namespace Modules\Accounts\Tests\Feature\Api;

use Tests\TestCase;
use Modules\Accounts\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectTest extends TestCase
{
    use RefreshDatabase;

    public function test_select2_api()
    {
        factory(User::class, 5)->create();

        $this->getJson(route('users.select'))
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);
    }
}
