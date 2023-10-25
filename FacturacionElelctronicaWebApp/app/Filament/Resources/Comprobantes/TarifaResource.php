<?php

namespace App\Filament\Resources\Comprobantes;

use App\Filament\Resources\Comprobantes\TarifaResource\Pages;
use App\Filament\Resources\Comprobantes\TarifaResource\RelationManagers;
use App\Models\Comprobantes\Tarifa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TarifaResource extends Resource
{
    protected static ?string $model = Tarifa::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('impuesto_id')
                    ->disabledOn('edit')
                    ->label(__('labels.tarifas.impuesto'))
                    ->required()
                    ->relationship('impuesto', 'nombre'),
                Forms\Components\TextInput::make('codigo_institucion')
                    ->label(__('labels.tarifas.codigo_institucion'))
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(10),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('descripcion')
                    ->label(__('labels.tarifas.descripcion'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('porcentaje')
                    ->required()
                    ->numeric()
                    ->default(0.00)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('impuesto.nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('codigo_institucion')
                    ->label(__('columns.tarifas.codigo_institucion'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->sortable()
                    ->label(__('columns.tarifas.descripcion'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('porcentaje')
                    ->sortable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('columns.general.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('columns.general.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('columns.general.deleted_at'))
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('impuesto')
                    ->multiple()
                    ->relationship('impuesto', 'nombre')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListTarifas::route('/'),
            'create' => Pages\CreateTarifa::route('/create'),
            'edit' => Pages\EditTarifa::route('/{record}/edit'),
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
