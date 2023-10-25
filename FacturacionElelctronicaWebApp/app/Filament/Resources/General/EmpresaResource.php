<?php

namespace App\Filament\Resources\General;

use App\Filament\Resources\General\EmpresaResource\Pages;
use App\Filament\Resources\General\EmpresaResource\RelationManagers;
use App\Models\General\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_identificacion')
                    ->unique(ignorable: fn ($record) => $record)
                    ->label(__('labels.empresas.numero_identificacion'))
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nombre_comercial')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('razon_social')
                    ->label(__('labels.empresas.razon_social'))
                    ->required()
                    ->maxLength(255)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_identificacion')
                    ->label(__('columns.empresas.numero_identificacion'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_comercial')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('razon_social')
                    ->sortable()
                    ->label(__('columns.empresas.razon_social'))
                    ->searchable(),
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
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
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
