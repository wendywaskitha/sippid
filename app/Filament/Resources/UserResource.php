<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Forms\Components\MultiSelect;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use STS\FilamentImpersonate\Impersonate;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-user.group');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')->required()->label(trans('filament-user::user.resource.name')),
            TextInput::make('email')->email()->required()->label(trans('filament-user::user.resource.email')),
            Forms\Components\TextInput::make('password')->label(trans('filament-user::user.resource.password'))
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state) use ($form){
                    if(!empty($state)){
                        return Hash::make($state);
                    }

                    $user = User::find($form->getColumns());
                    if($user){
                        return $user->password;
                    }
            }),
            TextInput::make('nip')->label('NIP')->required()->unique(),
            FileUpload::make('avatar')
                ->label('FOTO PROFIL')
                ->disk('public')
                ->directory('images')
                ->required(),
            Toggle::make('is_admin')->label('ADMIN')->required(),
            Toggle::make('is_active')->label('AKTIF'),
        ];

        if(config('filament-user.shield')){
            $rows[] = Select::make('roles')->multiple()->relationship('roles', 'name')->searchable()->preload()->label(trans('filament-user::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                // TextColumn::make('id')->sortable()->label(trans('filament-user::user.resource.id')),
                TextColumn::make('name')->sortable()->searchable()->label(trans('filament-user::user.resource.name')),
                TextColumn::make('email')->sortable()->searchable()->label(trans('filament-user::user.resource.email')),
                // BooleanColumn::make('email_verified_at')->sortable()->searchable()->label(trans('filament-user::user.resource.email_verified_at')),
                // Tables\Columns\TextColumn::make('created_at')->label(trans('filament-user::user.resource.created_at'))
                //     ->dateTime('M j, Y')->sortable(),
                // Tables\Columns\TextColumn::make('updated_at')->label(trans('filament-user::user.resource.updated_at'))
                //     ->dateTime('M j, Y')->sortable(),
                IconColumn::make('is_admin')
                    ->label('SUPER ADMIN')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('AKTIF')
                    ->boolean()
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter()
                    ->sortable(),

            ])
            
            

            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-user::user.resource.verified'))
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-user::user.resource.unverified'))
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')),
            ]);

        if(config('filament-user.impersonate')){
            $table->prependActions([
                Impersonate::make('impersonate'),
            ]);
        }


        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
