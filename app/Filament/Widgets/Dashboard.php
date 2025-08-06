<?php

namespace App\Filament\Widgets;

use App\Models\Datang;
use App\Models\Domisili;
use App\Models\Kelahiran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use App\Models\Keluarga;
use App\Models\Kematian;
use App\Models\Penduduk;
use App\Models\Pindah;

class Dashboard extends BaseWidget
{
    protected function getStats(): array
    {

        return [
    Stat::make('Data Keluarga', number_format(Keluarga::count(), 0, ',', '.'))
        ->description('Total Keluarga')
        ->descriptionIcon('heroicon-s-home-modern', IconPosition::Before)
        ->chart([3, 4, 5, 6, 5, 4])
        ->color('info'),

    Stat::make('Data Penduduk', number_format(Penduduk::count(), 0, ',', '.'))
        ->description('Total Penduduk')
        ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
        ->chart([4, 6, 7, 8, 9, 8])
        ->color('success'),

    Stat::make('Data Kelahiran', number_format(Kelahiran::count(), 0, ',', '.'))
        ->description('Total Kelahiran')
        ->descriptionIcon('heroicon-s-cake', IconPosition::Before)
        ->chart([1, 2, 3, 3, 4, 5])
        ->color('warning'),

    Stat::make('Data Kematian', number_format(Kematian::count(), 0, ',', '.'))
        ->description('Total Kematian')
        ->descriptionIcon('heroicon-s-exclamation-triangle', IconPosition::Before)
        ->chart([1, 1, 2, 1, 2, 3])
        ->color('danger'),

    Stat::make('Data Pindah', number_format(Pindah::count(), 0, ',', '.'))
        ->description('Total Pindah')
        ->descriptionIcon('heroicon-s-arrow-right', IconPosition::Before)
        ->chart([2, 3, 4, 3, 5, 4])
        ->color('gray'),

    Stat::make('Data Pendatang', number_format(Datang::count(), 0, ',', '.'))
        ->description('Total Pendatang')
        ->descriptionIcon('heroicon-s-arrow-left', IconPosition::Before)
        ->chart([1, 2, 3, 3, 4, 5])
        ->color('purple'),

    Stat::make('Data Domisili', number_format(Domisili::count(), 0, ',', '.'))
        ->description('Total Surat Domisili')
        ->descriptionIcon('heroicon-s-document-text', IconPosition::Before)
        ->chart([2, 3, 5, 6, 5, 4])
        ->color('primary'),
];
    }
}
