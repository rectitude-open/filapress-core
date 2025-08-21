<?php

declare(strict_types=1);

use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;
use RectitudeOpen\FilamentPhotos\Models\Photo;
use RectitudeOpen\FilamentPhotos\Models\PhotoCategory;
use RectitudeOpen\FilaPressCore\Filament\Pages\PhotoCategory as PhotoCategoryPage;
use RectitudeOpen\FilaPressCore\Filament\Resources\PhotoResource\Pages\CreatePhoto;
use RectitudeOpen\FilaPressCore\Filament\Resources\PhotoResource\Pages\EditPhoto;
use RectitudeOpen\FilaPressCore\Filament\Resources\PhotoResource\Pages\ListPhotos;
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

test('ensure photos section is accessible', function () {
    $response = $this->get('/admin-admin/photo/photos');
    $response->assertStatus(200);
    $response->assertSee('Photos');
});

test('ensure photo categories is accessible', function () {
    $response = $this->get('/admin-admin/photo/photo-category');
    $response->assertStatus(200);
    $response->assertSee('Photo Categories');
});

it('has a field on create form', function (string $field) {
    Livewire::test(CreatePhoto::class)
        ->assertFormFieldExists($field);
})->with(['title', 'url', 'pictures', 'description', 'slug', 'display_order', 'is_published', 'created_at', 'seo.title', 'seo.author', 'seo.description', 'seo.robots']);

test('can create a photos item', function () {
    $photoCategory = PhotoCategory::factory()->create();
    $categoryId = $photoCategory->id;

    Livewire::test(CreatePhoto::class)
        ->set('data.title', 'Test Photo')
        ->set('data.url', 'https://example.com/test-photo.jpg')
        ->set('data.description', 'This is a test photo description.')
        ->set('data.categories', [$categoryId])
        ->call('create');

    $this->assertDatabaseHas('photos', [
        'title' => 'Test Photo',
        'url' => 'https://example.com/test-photo.jpg',
        'description' => 'This is a test photo description.',
    ]);
});

test('can edit a photo item', function () {
    $photoCategory1 = PhotoCategory::factory()->create();
    $photo = Photo::factory()->create([]);
    $photo->categories()->attach($photoCategory1->id);

    $photoCategory2 = PhotoCategory::factory()->create();

    Livewire::test(EditPhoto::class, ['record' => $photo->id])
        ->set('data.title', 'Updated Test Photos')
        ->set('data.categories', [$photoCategory2->id])
        ->set('data.description', 'This is updated test photo description.')
        ->call('save');

    $this->assertDatabaseHas('photos', [
        'title' => 'Updated Test Photos',
        'description' => 'This is updated test photo description.',
    ])->assertDatabaseMissing('photos', [
        'title' => $photo->title,
        'description' => $photo->description,
    ])->assertDatabaseHas('pivot_photo_categories', [
        'photo_id' => $photo->id,
        'category_id' => $photoCategory2->id,
    ])->assertDatabaseMissing('pivot_photo_categories', [
        'photo_id' => $photo->id,
        'category_id' => $photoCategory1->id,
    ]);
});

test('can delete a photo item', function () {
    $photo = Photo::factory()->create();

    Livewire::test(ListPhotos::class)
        ->callTableBulkAction(DeleteBulkAction::class, [$photo]);

    $this->assertSoftDeleted('photos', [
        'id' => $photo->id,
    ]);
});

test('can list photos items', function () {
    $records = Photo::factory(3)->create();
    Livewire::test(ListPhotos::class)
        ->assertCanSeeTableRecords($records);
});

test('can list photos with pagination', function () {
    $records = Photo::factory(20)
        ->state(new Sequence(
            fn (Sequence $sequence) => ['created_at' => now()->subDays($sequence->index)],
        ))
        ->create();

    $sortedRecords = $records->sortByDesc('created_at');

    $this->assertDatabaseCount('photos', 20);
    Livewire::test(ListPhotos::class)
        ->call('gotoPage', 2)
        ->assertCanSeeTableRecords($sortedRecords->skip(10));
});

it('can create photo category item', function () {
    Livewire::test(PhotoCategoryPage::class)
        ->callAction('create')
        ->assertActionMounted('create')
        ->setActionData([
            'title' => 'Test Category',
        ])
        ->callMountedAction()
        ->assertHasNoActionErrors();

    $this->assertDatabaseHas('photo_categories', [
        'title' => 'Test Category',
    ]);
});
