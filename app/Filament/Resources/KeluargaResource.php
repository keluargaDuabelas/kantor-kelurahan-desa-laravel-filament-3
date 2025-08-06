<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatangRelationManagerResource\RelationManagers\DatangRelationManager;

use App\Filament\Resources\KelahiranRelationManagerResource\RelationManagers\KelahiranRelationManager;
use App\Filament\Resources\KeluargaResource\Pages;


use App\Filament\Resources\PendudukRelationManagerResource\RelationManagers\PendudukRelationManager as RelationManagersPendudukRelationManager;
use App\Filament\Resources\KeluargaResource\RelationManagers\KelahiranRelationManager as RelationManagersKelahiranRelationManager;
use App\Filament\Resources\KematianRelationManagerResource\RelationManagers\KematianRelationManager;
use App\Filament\Resources\PindahRelationManagerResource\RelationManagers\PindahRelationManager;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Dflydev\DotAccessData\Data;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CodeWithKyrian\FilamentDateRange\Tables\Filters\DateRangeFilter;
// use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;



class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;

    protected static ?string $navigationIcon = 'heroicon-c-building-office-2';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
    return 'Data Keluarga';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Keluarga';
    }


    public static function form(Form $form): Form
    {
        return $form

            ->schema([

                Forms\Components\TextInput::make('nomor_kepala_keluarga')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nik_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_kelamin_kepala_keluarga')
                    ->required()
                    ->searchable()
                ->options([
        'laki_laki' => 'Laki-Laki',
        'perempuan' => 'Perempuan',

    ])
    ->native(false),

                Forms\Components\DatePicker::make('tanggal_lahir_kepala_keluarga')
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rt_kepala_keluarga')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rw_kepala_keluarga')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('penduduk_id')->hidden()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\TextColumn::make('nomor_kepala_keluarga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_kepala_keluarga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_kepala_keluarga')
                    ->searchable(),
               Tables\Columns\TextColumn::make('tempat_lahir_kepala_keluarga')
               ->label('Tempat Lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir_kepala_keluarga')
                ->label('Tanggal Lahir')
                ->date()
                    ->sortable(),


            ])
            ->filters([
            DateRangeFilter::make('created_at')
            ->label('Created within'),

            ])
            ->actions([

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           RelationManagersPendudukRelationManager::class,
          KelahiranRelationManager::class,
          KematianRelationManager::class,
          PindahRelationManager::class,
          DatangRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeluargas::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}
