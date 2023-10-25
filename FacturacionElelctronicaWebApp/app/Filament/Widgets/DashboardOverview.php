<?php

namespace App\Filament\Widgets;

use App\Models\Comprobantes\PuntoEmision;
use App\Models\General\Cliente;
use App\Models\General\Empresa;
use App\Models\General\Establecimiento;
use App\Models\General\Item;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('dashboard.empresas_stats'), Empresa::count()),
            Stat::make(__('dashboard.establecimientos_stats'), Establecimiento::count()),
            Stat::make(__('dashboard.puntos_emision_stats'), PuntoEmision::count()),
            Stat::make(__('dashboard.usuarios_stats'), User::count()),
            Stat::make(__('dashboard.clientes_stats'), Cliente::count()),
            Stat::make(__('dashboard.items_stats'), Item::count())
        ];
    }
}
