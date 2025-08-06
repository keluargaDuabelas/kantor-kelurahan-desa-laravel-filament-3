<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DatangResource\Pages;
use App\Filament\Resources\DatangResource\RelationManagers;
use App\Models\Datang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Keluarga;
use CodeWithKyrian\FilamentDateRange\Tables\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DatangResource extends Resource
{
    protected static ?string $model = Datang::class;

    protected static ?string $navigationIcon = 'heroicon-c-truck';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
    return 'Data Pendatang';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Pendatang';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_pindah')
                ->required()
                ->label('Tanggal Datang'),
                  Forms\Components\Select::make('keluarga_id')
                ->label('Nomor Kepala keluarga')
                ->required()
                ->options(Keluarga::all()->pluck('nomor_kepala_keluarga', 'id'))
                ->searchable()
                ->columnSpan(2),
                 Forms\Components\Select::make('penduduk_id')

                ->required()

            ->options(function (callable $get) {
        $keluargaId = $get('keluarga_id');
        if (!$keluargaId) {
            return [];
        }

        return \App\Models\Penduduk::where('keluarga_id', $keluargaId)
            ->pluck('nama', 'id');
    })
            ->label('nama_penduduk')
                ->searchable()
                ->columnSpan(2),
               Forms\Components\Select::make('alasan_datang')
                    ->required()
                    ->searchable()
                    ->options([
        'pekerjaan' => 'Pekerjaan',
        'pendidikan' => 'Pendidikan',
        'keamanan' => 'Keamanan',
        'kesehatan' => 'Kesehatan',
        'keluarga' => 'Keluarga',
        'perumahan' => 'Perumahan',
        'bencana_alam' => 'Bencana Alam',
        'ekonomi' => 'Ekonomi',
        'perkawinan' => 'Perkawinan',
        'perceraian' => 'Perceraian',
        'mengikuti_orang_tua' => 'Mengikuti Orang Tua',
        'mengikuti_pasangan' => 'Mengikuti Suami/Istri',
        'dinas' => 'Dinas/Tugas Negara',
        'lainnya' => 'Lainnya',
    ]),
                Forms\Components\TextInput::make('desa_asal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kecamatan_asal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kabupaten_asal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provinsi_asal')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_pindah')
                    ->date()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penduduk.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alasan_datang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('desa_asal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan_asal')
                    ->searchable(),



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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDatangs::route('/'),
        ];
    }
}
