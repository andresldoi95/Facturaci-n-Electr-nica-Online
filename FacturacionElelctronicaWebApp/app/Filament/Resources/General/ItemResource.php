<?php

namespace App\Filament\Resources\General;

use App\Filament\Resources\General\ItemResource\Pages;
use App\Filament\Resources\General\ItemResource\RelationManagers;
use App\Models\General\Item;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('empresa_id')
                    ->disabledOn('edit')
                    ->required()
                    ->searchable()
                    ->relationship('empresa', 'nombre_comercial'),
                Select::make('categoria_id')
                    ->label(__('labels.items.categoria'))
                    ->required()
                    ->relationship('categoria', 'nombre')
                    ->createOptionForm([
                        TextInput::make('nombre')
                            ->required()
                            ->unique()
                            ->maxLength(255)
                    ]),
                TextInput::make('codigo')
                    ->maxLength(20)
                    ->disabledOn('edit')
                    ->label(__('labels.items.codigo'))
                    ->unique(ignorable: fn ($record) => $record)
                    ->required(),
                TextInput::make('nombre')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('descripcion')
                    ->label(__('labels.items.descripcion'))
                    ->maxLength(255),
                Select::make('tarifa_id')
                    ->required()
                    ->relationship('tarifa', 'nombre'),
                TextInput::make('precio')
                    ->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('empresa.nombre_comercial')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('categoria.nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('codigo')
                    ->label(__('columns.items.codigo'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->label(__('columns.items.descripcion'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tarifa.nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('precio')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('columns.general.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('columns.general.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('columns.general.deleted_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('empresa')
                    ->searchable()
                    ->multiple()
                    ->relationship('empresa', 'nombre_comercial'),
                Tables\Filters\SelectFilter::make('categoria')
                    ->searchable()
                    ->multiple()
                    ->relationship('categoria', 'nombre')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
