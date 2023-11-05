<?php

namespace App\Filament\Resources\Comprobantes;

use App\Filament\Resources\Comprobantes\ComprobanteResource\Pages;
use App\Models\Comprobantes\Comprobante;
use App\Models\Comprobantes\PuntoEmision;
use App\Models\General\Cliente;
use App\Models\General\Item;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComprobanteResource extends Resource
{
    protected static ?string $model = Comprobante::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    private static function calcularTotales(Set $set)
    {
        //To Do
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Comprobante')
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
                                    ->default(Carbon::now())
                                    ->required(),
                                Forms\Components\Select::make('punto_emision_id')
                                    ->disabledOn('edit')
                                    ->label(__('labels.comprobantes.cabecera.punto_emision'))
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        if (blank($state)) return;

                                        $puntoEmision = PuntoEmision::findOrFail($state);
                                        $ultimoComprobante  = Comprobante::orderByRaw('cast(numero_documento as unsigned) desc')
                                            ->where('punto_emision_id', $puntoEmision->id)
                                            ->first();
                                        $set('numero_documento', !isset($ultimoComprobante) ? $puntoEmision->numero_inicial : intval($ultimoComprobante->numero_documento) + 1);
                                    })
                                    ->relationship('puntoEmision', 'nombre'),
                                Forms\Components\TextInput::make('numero_documento')
                                    ->label(__('labels.comprobantes.cabecera.numero_documento'))
                                    ->integer()
                                    ->required()
                            ]),
                        Tabs\Tab::make('informacion_adicional')
                            ->label(__('labels.comprobantes.informacion_adicional'))
                            ->schema([
                                Repeater::make('informacionAdicional')
                                    ->label(__('labels.comprobantes.informacion_adicional'))
                                    ->columns(4)
                                    ->relationship('informacionAdicional')
                                    ->collapsible()
                                    ->default([])
                                    ->schema([
                                        Forms\Components\TextInput::make('clave')
                                            ->maxLength(300)
                                            ->required(),
                                        Forms\Components\TextInput::make('valor')
                                            ->required()
                                            ->maxLength(300)
                                            ->unique(),
                                        Forms\Components\Toggle::make('mostrar')
                                            ->default(true),
                                        Forms\Components\Toggle::make('enviar')
                                            ->default(true)
                                    ])
                            ]),
                    ]),
                Section::make('Detalles')
                    ->columnSpan(2)
                    ->schema([
                        Repeater::make('detalles')
                            ->hiddenLabel()
                            ->columns(4)
                            ->relationship('detalles')
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => Item::find($state['item_id'])->nombre ?? __('labels.comprobantes.detalles.item'))
                            ->schema([
                                Forms\Components\Select::make('item_id')
                                    ->label(__('labels.comprobantes.detalles.item'))
                                    ->required()
                                    ->columnSpan(2)
                                    ->live()
                                    ->searchable([
                                        'codigo', 'nombre', 'descripcion'
                                    ])
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        if (blank($state)) return;

                                        $item = Item::findOrFail($state);
                                        $set('precio', $item->precio);
                                    })
                                    ->getOptionLabelFromRecordUsing(fn (Item $record) => "{$record->codigo} - {$record->nombre}")
                                    ->relationship('item', 'nombre'),
                                Forms\Components\TextInput::make('cantidad')
                                    ->default(1)
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('precio')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('porcentaje_descuento')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                Forms\Components\TextInput::make('subtotal_si')
                                    ->numeric()
                                    ->default(0)
                                    ->readOnly()
                                    ->required(),
                                Forms\Components\TextInput::make('descuento_total')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                Forms\Components\TextInput::make('subtotal')
                                    ->numeric()
                                    ->default(0)
                                    ->readOnly()
                                    ->required(),
                                Forms\Components\TextInput::make('impuestos')
                                    ->numeric()
                                    ->default(0)
                                    ->readOnly()
                                    ->required(),
                                Forms\Components\TextInput::make('total')
                                    ->numeric()
                                    ->default(0)
                                    ->readOnly()
                                    ->required(),
                                Repeater::make('impuestosDetalle')
                                    ->addable(false)
                                    ->deletable(false)
                                    ->columns(4)
                                    ->columnSpan(4)
                                    ->default([])
                                    ->collapsible()
                                    ->relationship('impuestos')
                                    ->schema([
                                        Forms\Components\Select::make('tarifa_id')
                                            ->label(__('labels.comprobantes.detalles.tarifa'))
                                            ->disabled()
                                            ->required()
                                            ->unique()
                                            ->relationship('tarifa', 'nombre'),
                                        Forms\Components\TextInput::make('base_imponible')
                                            ->readOnly()
                                            ->numeric()
                                            ->required(),
                                        Forms\Components\TextInput::make('tarifa')
                                            ->readOnly()
                                            ->numeric()
                                            ->required(),
                                        Forms\Components\TextInput::make('valor')
                                            ->readOnly()
                                            ->numeric()
                                            ->required()
                                    ]),
                                Repeater::make('informacionAdicional')
                                    ->columns(4)
                                    ->columnSpan(4)
                                    ->default([])
                                    ->collapsible()
                                    ->relationship('informacionAdicional')
                                    ->schema([
                                        Forms\Components\TextInput::make('clave')
                                            ->maxLength(300)
                                            ->required(),
                                        Forms\Components\TextInput::make('valor')
                                            ->required()
                                            ->maxLength(300)
                                            ->unique(),
                                        Forms\Components\Toggle::make('mostrar')
                                            ->default(true),
                                        Forms\Components\Toggle::make('enviar')
                                            ->default(true)
                                    ])
                            ])
                    ]),
                Section::make('totales')
                    ->heading(__('labels.comprobantes.totales.label'))
                    ->columnSpan(1)
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('subtotal_si')
                            ->required()
                            ->label(__('labels.comprobantes.totales.subtotal_si'))
                            ->default(0)
                            ->numeric()
                            ->readOnly(),
                        Forms\Components\TextInput::make('descuento_total')
                            ->required()
                            ->default(0)
                            ->numeric()
                            ->readOnly(),
                        Forms\Components\TextInput::make('subtotal')
                            ->required()
                            ->default(0)
                            ->numeric()
                            ->readOnly(),
                        Forms\Components\TextInput::make('impuestos')
                            ->required()
                            ->default(0)
                            ->numeric()
                            ->readOnly(),
                        Forms\Components\TextInput::make('total')
                            ->required()
                            ->default(0)
                            ->numeric()
                            ->readOnly()
                    ]),
                Section::make('totalesImpuestoComprobante')
                    ->heading(__('labels.comprobantes.totales.impuestos'))
                    ->columnSpan(1)
                    ->columns(4)
                    ->schema([
                        Repeater::make('impuestosComprobante')
                            ->addable(false)
                            ->deletable(false)
                            ->columns(4)
                            ->columnSpan(3)
                            ->default([])
                            ->collapsible()
                            ->hiddenLabel()
                            ->relationship('impuestos')
                            ->schema([
                                Forms\Components\Select::make('tarifa_id')
                                    ->label(__('labels.comprobantes.detalles.tarifa'))
                                    ->disabled()
                                    ->required()
                                    ->unique()
                                    ->relationship('tarifa', 'nombre'),
                                Forms\Components\TextInput::make('base_imponible')
                                    ->readOnly()
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('tarifa')
                                    ->readOnly()
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('valor')
                                    ->readOnly()
                                    ->numeric()
                                    ->required()
                            ])
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
