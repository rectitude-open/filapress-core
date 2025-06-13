<?php

declare(strict_types=1);
use Filament\Tables\Actions\DeleteBulkAction;
use Livewire\Livewire;
use RectitudeOpen\FilamentNews\Models\News;
use RectitudeOpen\FilamentNews\Models\NewsCategory;
use RectitudeOpen\FilaPressCore\Filament\Resources\NewsResource\Pages\CreateNews;
use RectitudeOpen\FilaPressCore\Filament\Resources\NewsResource\Pages\EditNews;
use RectitudeOpen\FilaPressCore\Filament\Resources\NewsResource\Pages\ListNews;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create([
        'name' => 'super-admin',
        'guard_name' => 'admin',
    ]);
    $this->superAdmin = Admin::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@test.com',
        'password' => bcrypt('superadmin'),
    ]);
    $this->superAdmin->assignRole('super-admin');
    $this->actingAs($this->superAdmin, 'admin');
});

test('ensure news section is accessible', function () {
    $response = $this->get('/admin-admin/news/news');
    $response->assertStatus(200);
    $response->assertSee('New news');
});

test('ensure news categories is accessible', function () {
    $response = $this->get('/admin-admin/news/news-category');
    $response->assertStatus(200);
    $response->assertSee('New news category');
});

test('ensure news tags is accessible', function () {
    $response = $this->get('/admin-admin/news/news-tags');
    $response->assertStatus(200);
    $response->assertSee('No tags');
});

test('can create a news item', function () {
    $newsCategory = NewsCategory::factory()->create();
    $categoryId = $newsCategory->id;

    Livewire::test(CreateNews::class)
        ->set('data.title', 'Test News')
        ->set('data.categories', [$categoryId])
        ->set('data.content', 'This is a test news content.')
        ->call('create');

    $this->assertDatabaseHas('news', [
        'title' => 'Test News',
        'content' => 'This is a test news content.',
    ]);
});

test('can edit a news item', function () {
    $newsCategory1 = NewsCategory::factory()->create();
    $news = News::factory()->create([]);
    $news->categories()->attach($newsCategory1->id);

    $newsCategory2 = NewsCategory::factory()->create();

    Livewire::test(EditNews::class, ['record' => $news->id])
        ->set('data.title', 'Updated Test News')
        ->set('data.categories', [$newsCategory2->id])
        ->set('data.content', 'This is updated test news content.')
        ->call('save');

    $this->assertDatabaseHas('news', [
        'title' => 'Updated Test News',
        'content' => 'This is updated test news content.',
    ])->assertDatabaseMissing('news', [
        'title' => $news->title,
        'content' => $news->content,
    ])->assertDatabaseHas('pivot_news_categories', [
        'news_id' => $news->id,
        'category_id' => $newsCategory2->id,
    ])->assertDatabaseMissing('pivot_news_categories', [
        'news_id' => $news->id,
        'category_id' => $newsCategory1->id,
    ]);
});

test('can delete a news item', function () {
    $news = News::factory()->create();

    Livewire::test(ListNews::class)
        ->callTableBulkAction(DeleteBulkAction::class, [$news]);

    $this->assertSoftDeleted('news', [
        'id' => $news->id,
    ]);
});

test('can list news items', function () {
    $news1 = News::factory()->create(['title' => 'News 1']);
    $news2 = News::factory()->create(['title' => 'News 2']);

    Livewire::test(ListNews::class)
        ->assertSee($news1->title)
        ->assertSee($news2->title);
});
