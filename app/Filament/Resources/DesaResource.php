<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Desa;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DesaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DesaResource\RelationManagers;

class DesaResource extends Resource
{
    protected static ?string $model = Desa::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Desa / Kelurahan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('kecamatan_id')
                        ->label('KECAMATAN')
                        ->relationship('kecamatan','nm_kecamatan')
                        ->preload()
                        ->searchable()
                        ->required(),
                    TextInput::make('nm_desa')
                        ->label('DESA/KECAMATAN')
                        ->required(),
                    Textarea::make('ket')
                        ->label('KETERANGAN')
                ])->inlineLabel()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->label('NO')->rowIndex(),
                TextColumn::make('kecamatan.nm_kecamatan')->label('KECAMATAN')->searchable(),
                TextColumn::make('nm_desa')->label('DESA/KELURAHAN')->searchable(),
            ])
            ->filters([
                SelectFilter::make('nm_desa')->label('DESA/KELURA')->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDesas::route('/'),
            'create' => Pages\CreateDesa::route('/create'),
            'edit' => Pages\EditDesa::route('/{record}/edit'),
        ];
    }    
}
