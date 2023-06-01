<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Instansi;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InstansiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstansiResource\RelationManagers;

class InstansiResource extends Resource
{
    protected static ?string $model = Instansi::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nm_instansi')
                        ->label('NAMA DINAS')
                        ->required(),
                    Textarea::make('alamat')
                        ->label('ALAMAT')
                        ->required(),
                    TextInput::make('email')
                        ->label('EMAIL')
                        ->required(),
                    TextInput::make('tlp')
                        ->label('NO TELEPON')
                        ->required(),
                    TextInput::make('nm_kadis')
                        ->label('KEPALA DINAS')
                        ->required(),
                    TextInput::make('nip')
                        ->label('NIP')
                        ->required(),
                    FileUpload::make('logo')
                        ->label('LOGO INSATANSI')
                        ->disk('public')
                        ->directory('images')
                        ->preserveFilenames()
                        ->imagePreviewHeight('250')
                        ->loadingIndicatorPosition('left')
                        ->panelAspectRatio('2:1')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('right')
                        ->uploadButtonPosition('left')
                        ->uploadProgressIndicatorPosition('left'),
                ])->inlineLabel()
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nm_instansi')->label('NAMA DINAS'),
                TextColumn::make('nm_kadis')->label('KEPALA DINAS'),
                TextColumn::make('nip')->label('NIP'),
                ImageColumn::make('logo')->label('LOGO INSATANSI')->alignCenter()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstansis::route('/'),
            'create' => Pages\CreateInstansi::route('/create'),
            'edit' => Pages\EditInstansi::route('/{record}/edit'),
        ];
    }    
}
