<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use RectitudeOpen\FilaPressCore\Filament\Resources\AdminResource\Pages;
use RectitudeOpen\FilaPressCore\Models\Admin;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class AdminResource extends Resource
{
    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function getModel(): string
    {
        return static::$model ?? config('filapress-core.admin_model', Admin::class);
    }

    public static function getNavigationLabel(): string
    {
        return __('menu.nav_item.admin');
    }

    public static function getLabel(): string
    {
        return __('menu.nav_item.admin');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('menu.nav_group.security');
    }

    public function getTitle(): string
    {
        return __('menu.nav_item.admin');
    }

    public static function getRelations(): array
    {
        return [
            AuditsRelationManager::class,
        ];
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')
                ->required()
                ->label(trans('filament-users::user.resource.name')),
            TextInput::make('email')
                ->email()
                ->required()
                ->label(trans('filament-users::user.resource.email')),
            TextInput::make('password')
                ->label(trans('filament-users::user.resource.password'))
                ->required()
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state, $record) {
                    return ! empty($state)
                        ? Hash::make($state)
                        : $record->password;
                }),
        ];

        if (config('filament-users.shield') && class_exists(\BezhanSalleh\FilamentShield\FilamentShield::class)) {
            $rows[] = Forms\Components\Select::make('roles')
                ->multiple()
                ->preload()
                ->relationship('roles', 'name')
                ->label(trans('filament-users::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        // if (class_exists(STS\FilamentImpersonate\Tables\Actions\Impersonate::class) && config('filament-users.impersonate')) {
        //     $table->actions([Impersonate::make('impersonate')]);
        // }
        $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->label(trans('filament-users::user.resource.id')),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-users::user.resource.name')),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-users::user.resource.email')),
                TextColumn::make('created_at')
                    ->label(trans('filament-users::user.resource.created_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(trans('filament-users::user.resource.updated_at'))
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-users::user.resource.verified'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-users::user.resource.unverified'))
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ]);

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
