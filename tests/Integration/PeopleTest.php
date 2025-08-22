<?php

declare(strict_types=1);

use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;
use RectitudeOpen\FilamentPeople\Models\Person;
use RectitudeOpen\FilamentPeople\Models\PersonCategory;
use RectitudeOpen\FilaPressCore\Filament\Pages\PersonCategory as PersonCategoryPage;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages\CreatePerson;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages\EditPerson;
use RectitudeOpen\FilaPressCore\Filament\Resources\PersonResource\Pages\ListPeople;
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

test('ensure people section is accessible', function () {
    $response = $this->get('/admin-admin/people/people');
    $response->assertStatus(200);
    $response->assertSee('People');
});

test('ensure person categories is accessible', function () {
    $response = $this->get('/admin-admin/people/person-category');
    $response->assertStatus(200);
    $response->assertSee('Person Categories');
});

it('has a field on create form', function (string $field) {
    Livewire::test(CreatePerson::class)
        ->assertFormFieldExists($field);
})->with(['name', 'title', 'email', 'phone', 'bio', 'tagline', 'sidebar', 'categories', 'slug', 'display_order', 'is_published', 'created_at', 'seo.title', 'seo.author', 'seo.description', 'seo.robots']);

test('can create a people item', function () {
    $personCategory = PersonCategory::factory()->create();
    $categoryId = $personCategory->id;

    Livewire::test(CreatePerson::class)
        ->set('data.name', 'Test Person')
        ->set('data.categories', [$categoryId])
        ->set('data.title', 'Test Title')
        ->set('data.bio', 'This is a test person biography.')
        ->call('create');

    $this->assertDatabaseHas('people', [
        'name' => 'Test Person',
        'title' => 'Test Title',
        'bio' => 'This is a test person biography.',
    ]);
});

test('can edit a person item', function () {
    $personCategory1 = PersonCategory::factory()->create();
    $person = Person::factory()->create([]);
    $person->categories()->attach($personCategory1->id);

    $personCategory2 = PersonCategory::factory()->create();

    Livewire::test(EditPerson::class, ['record' => $person->id])
        ->set('data.name', 'Updated Test People')
        ->set('data.categories', [$personCategory2->id])
        ->set('data.bio', 'This is updated test person biography.')
        ->call('save');

    $this->assertDatabaseHas('people', [
        'name' => 'Updated Test People',
        'bio' => 'This is updated test person biography.',
    ])->assertDatabaseMissing('people', [
        'name' => $person->name,
        'bio' => $person->bio,
    ])->assertDatabaseHas('pivot_person_categories', [
        'people_id' => $person->id,
        'category_id' => $personCategory2->id,
    ])->assertDatabaseMissing('pivot_person_categories', [
        'people_id' => $person->id,
        'category_id' => $personCategory1->id,
    ]);
});

test('can delete a person item', function () {
    $person = Person::factory()->create();

    Livewire::test(ListPeople::class)
        ->callTableBulkAction(DeleteBulkAction::class, [$person]);

    $this->assertSoftDeleted('people', [
        'id' => $person->id,
    ]);
});

test('can list people items', function () {
    $records = Person::factory(3)->create();
    Livewire::test(ListPeople::class)
        ->assertCanSeeTableRecords($records);
});

test('can list people with pagination', function () {
    $records = Person::factory(20)
        ->state(new Sequence(
            fn (Sequence $sequence) => ['created_at' => now()->subDays($sequence->index)],
        ))
        ->create();

    $sortedRecords = $records->sortByDesc('created_at');

    $this->assertDatabaseCount('people', 20);
    Livewire::test(ListPeople::class)
        ->call('gotoPage', 2)
        ->assertCanSeeTableRecords($sortedRecords->skip(10));
});

it('can create person category item', function () {
    Livewire::test(PersonCategoryPage::class)
        ->callAction('create')
        ->assertActionMounted('create')
        ->setActionData([
            'title' => 'Test Category',
        ])
        ->callMountedAction()
        ->assertHasNoActionErrors();

    $this->assertDatabaseHas('person_categories', [
        'title' => 'Test Category',
    ]);
});
