<?php

namespace App\Filament\App\Resources;

use UnitEnum;
use BackedEnum;
use App\Filament\App\Resources\ChanResource\Pages;
use App\Models\Chan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ChanResource extends Resource
{
    protected static ?string $model = Chan::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | UnitEnum | null $navigationGroup = 'Person';

    protected static ?string $navigationLabel = ' Chan';

    // protected static ?string $tenantRelationshipName = 'team';

    #[\Override]
    public static function form(Schema $form): Schema
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('group')
                ->maxLength(255),
            Forms\Components\TextInput::make('gid')
                ->numeric(),
            Forms\Components\TextInput::make('date')
                ->maxLength(255),
            Forms\Components\TextInput::make('time')
                ->maxLength(255),
        ]);
    }

    #[\Override]
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('group')
                ->searchable(),
            Tables\Columns\TextColumn::make('gid')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('date')
                ->searchable(),
            Tables\Columns\TextColumn::make('time')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListChans::route('/'),
            'create' => Pages\CreateChan::route('/create'),
            'edit'   => Pages\EditChan::route('/{record}/edit'),
        ];
    }
}
