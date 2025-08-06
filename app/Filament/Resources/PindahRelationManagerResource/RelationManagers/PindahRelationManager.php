<?php

namespace App\Filament\Resources\PindahRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
USE App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PindahRelationManager extends RelationManager
{
    protected static string $relationship = 'pindah';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal_pindah'),
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
                Forms\Components\Select::make('alasan_pindah')
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
                Forms\Components\TextInput::make('desa_tujuan')
                ->label('Desa/Kelurahan Tujuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kecamatan_tujuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kabupaten_tujuan')
                ->label('Kota/Kabupaten Tujuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provinsi_tujuan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                 Tables\Columns\TextColumn::make('tanggal_pindah')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penduduk.nama')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alasan_pindah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('desa_tujuan')
                ->label('Desa/Kelurahan Tujuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan_tujuan')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
