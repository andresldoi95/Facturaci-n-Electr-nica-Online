<?php

namespace App\Filament\Resources\General;

use App\Filament\Resources\General\ClienteResource\Pages;
use App\Models\General\Cliente;
use App\Models\General\TipoIdentificacion;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo_identificacion_id')
                    ->label(__('labels.clientes.tipo_identificacion'))
                    ->required()
                    ->relationship('tipoIdentificacion', 'nombre')
                    ->disabledOn('edit')
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if(blank($state)) return;

                        $tipoIdentificacion = TipoIdentificacion::findOrFail($state);
                        $set('numero_identificacion', isset($tipoIdentificacion->identificacion_defecto)?$tipoIdentificacion->identificacion_defecto:'');
                    }),
                TextInput::make('numero_identificacion')
                    ->required()
                    ->disabledOn('edit')
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(20),
                TextInput::make('nombre_razon_social')
                    ->required()
                    ->maxLength(500),
                TextInput::make('nombre_comercial')
                    ->maxLength(255),
                TextInput::make('direccion')
                    ->required()
                    ->maxLength(300),
                Forms\Components\Textarea::make('observacion')
                    ->maxLength(500),
                Repeater::make('correos')
                    ->columnSpan(2)
                    ->relationship()
                    ->addActionLabel(__('actions.clientes.add_correos'))
                    ->label(__('labels.clientes.correos'))
                    ->deleteAction(
                        fn (Action $action) => $action->requiresConfirmation(),
                    )
                    ->schema([
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255),
                        Toggle::make('active')
                            ->inline()
                            ->label(__('labels.clientes.active'))
                            ->default(true)
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tipoIdentificacion.nombre')
                    ->label(__('columns.clientes.tipo_identificacion'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero_identificacion')
                    ->label(__('columns.clientes.numero_identificacion'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_razon_social')
                    ->label(__('columns.clientes.nombre_razon_social'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre_comercial')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->sortable()
                    ->label(__('columns.clientes.direccion'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('observacion')
                    ->label(__('columns.clientes.observacion'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('correos.email'),
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
                Tables\Filters\SelectFilter::make('tipoIdentificacion')
                    ->searchable()
                    ->multiple()
                    ->relationship('tipoIdentificacion', 'nombre'),
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
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
