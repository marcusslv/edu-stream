<?php

namespace Tests\Feature\CatalogVideoTest;

use App\Domains\User\Entities\UserEntity;
use App\Domains\User\Enums\RolesEnum;
use App\Domains\VideoManagement\CastMember\Entities\CastMemberEntity;
use App\Domains\VideoManagement\Enums\CastMemberRoleEnum;
use App\Domains\VideoManagement\Enums\VideoRatingEnum;
use App\Domains\VideoManagement\Video\Entities\VideoEntity;
use App\Models\VideoManagement\Category\Category;
use App\Models\VideoManagement\Genre\Genre;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriberCustomerWatchesTheVideoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesSeeder::class);
    }

    public function test_if_subscriber_customer_watches_the_video(): void
    {
        $customer = UserEntity::factory()->create();
        $customer->assignRole(RolesEnum::CLIENT->value);
        $token = $customer->createToken('client_token')->plainTextToken;
        $video = VideoEntity::factory()->create([
            'title' => 'Title Test',
            'description' => 'Description Test',
            'duration' => 90,
            'release_date' => '2021-01-01',
            'rating' => VideoRatingEnum::L,
            'is_published' => true,
            'category_id' => Category::factory()->create([
                'name' => 'Category Test',
                'description' => 'Description Test'
            ]),
            'genre_id' => Genre::factory()->create([
                'name' => 'Genre Test',
                'description' => 'Description Test',
            ]),
        ]);

        $castMember = CastMemberEntity::factory()->create([
            'name' => 'Name Test 2',
            'role' => CastMemberRoleEnum::DIRECTOR->value,
            'bio' => 'Bio Test',
        ]);

        $castMember2 = CastMemberEntity::factory()->create([
            'name' => 'Name Test 1',
            'role' => CastMemberRoleEnum::ACTOR->value,
            'bio' => 'Bio Test',
        ]);

        $video->castMembers()->attach($castMember);
        $video->castMembers()->attach($castMember2);

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/watch/1?with[]=category&with[]=genre&with[]=castMembers');


        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'success',
            'status' => 200,
            'show' => false,
            'data' => [
                'id' => 1,
                'title' => 'Title Test',
                'description' => 'Description Test',
                'duration' => 90,
                'release_date' => '2021-01-01',
                'rating' => VideoRatingEnum::labelByName('L'),
                'is_published' => true,
                'category' => $video->category->toArray(),
                'genre' => $video->genre->toArray(),
                'cast_members' => [
                    $castMember->toArray(),
                    $castMember2->toArray(),
                ],
                'created_at' => $video->created_at->toISOString(),
            ],
        ]);
    }
}
