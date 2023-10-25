<?php

namespace App\Filament\Resources\Comprobantes;

use App\Filament\Resources\Comprobantes\ComprobanteResource\Pages;
use App\Filament\Resources\Comprobantes\ComprobanteResource\RelationManagers;
use App\Models\Comprobantes\Comprobante;
use App\Models\General\Cliente;
use App\Models\General\Item;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComprobanteResource extends Resource
{
    protected static ?string $model = Comprobante::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Label')
                    ->columnSpan(2)
                    ->tabs([
                        Tabs\Tab::make('informacion')
                            ->columns(3)
                            ->label(__('labels.comprobantes.informacion'))
                            ->schema([
                                Forms\Components\Select::make('cliente_id')
                                    ->disabledOn('edit')
                                    ->label(__('labels.comprobantes.cabecera.cliente'))
                                    ->required()
                                    ->searchable([
                                        'nombre_razon_social', 'numero_identificacion', 'nombre_comercial'
                                    ])
                                    ->columnSpan(2)
                                    ->getOptionLabelFromRecordUsing(fn (Cliente $record) => "{$record->nombre_razon_social}" . (!$record->nombre_comercial ? '' : " ({$record->nombre_comercial})") .  " - {$record->numero_identificacion}")
                                    ->relationship('cliente', 'nombre_razon_social'),
                                Forms\Components\DateTimePicker::make('fecha_emision')
                                    ->label(__('labels.comprobantes.cabecera.fecha_emision'))
                                    ->required(),
                                Forms\Components\Select::make('punto_emision_id')
                                    ->disabledOn('edit')
                                    ->label(__('labels.comprobantes.cabecera.punto_emision'))
                                    ->required()
                                    ->relationship('puntoEmision', 'nombre'),
                                Forms\Components\TextInput::make('numero_documento')
                                    ->label(__('labels.comprobantes.cabecera.numero_documento'))
                                    ->integer()
                                    ->required()
                            ]),
                        Tabs\Tab::make('Detalles')
                            ->schema([
                                Repeater::make('detalles')
                                    ->columns(3)
                                    ->relationship('detalles')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Select::make('item_id')
                                            ->label(__('labels.comprobantes.detalles.item'))
                                            ->required()
                                            ->searchable([
                                                'codigo', 'nombre', 'descripcion'
                                            ])
                                            ->getOptionLabelFromRecordUsing(fn (Item $record) => "{$record->codigo} - {$record->nombre}")
                                            ->relationship('item', 'nombre'),
                                        Forms\Components\TextInput::make('cantidad')
                                            ->numeric()
                                            ->required(),
                                        Forms\Components\TextInput::make('precio')
                                            ->numeric()
                                            ->required()
                                    ])
                            ]),
                        Tabs\Tab::make('Totales')
                            ->schema([
                                // ...
                            ]),
                        Tabs\Tab::make('informacion_adicional')
                            ->label(__('labels.comprobantes.informacion_adicional'))
                            ->schema([
                                // ...
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
                    Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListComprobantes::route('/'),
            'create' => Pages\CreateComprobante::route('/create'),
            'edit' => Pages\EditComprobante::route('/{record}/edit'),
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
