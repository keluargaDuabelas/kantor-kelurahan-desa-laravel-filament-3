<?php

namespace App\Filament\Resources\KematianRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KematianRelationManager extends RelationManager
{
    protected static string $relationship = 'kematian';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\DatePicker::make('tanggal_kematian')
                    ->required(),
                Forms\Components\TimePicker::make('jam_kematian')
                    ->required(),
                Forms\Components\Select::make('sebab_kematian')
                    ->required()
                    ->searchable()
                     ->options([
        'wajar' => 'Wajar',
        'kecelakaan' => 'Kecelakaan',
        'pembunuhan' => 'Pembunuhan',
        'bunuh_diri' => 'Bunuh Diri',
        'tidak_diketahui' => 'Tidak Diketahui',
        'lainnya' => 'Lainnya',
    ]),

                Forms\Components\Select::make('tempat_kematian')
                    ->required()
                    ->searchable()
                     ->options([
        'rumah' => 'Rumah',
        'rumah_sakit' => 'Rumah Sakit',
        'puskesmas' => 'Puskesmas',
        'jalan_raya' => 'Jalan Raya',
        'kebun' => 'Kebun',
        'sawah' => 'Sawah',
        'tempat_umum' => 'Tempat Umum',
        'di_perjalanan' => 'Di Perjalanan',
        'lainnya' => 'Lainnya',
    ]),
                Forms\Components\TextInput::make('alamat_kematian')
                    ->required()
                    ->placeholder('Contoh: Jl. Melati No. 15 RT 04 RW 02, Desa Mekarjaya')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_pelapor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('hubungan_pelapor')
                    ->required()
                    ->searchable()
                      ->options([
        'ayah' => 'Ayah',
        'ibu' => 'Ibu',
        'suami' => 'Suami',
        'istri' => 'Istri',
        'anak' => 'Anak',
        'saudara_kandung' => 'Saudara Kandung',
        'keluarga_lain' => 'Keluarga Lain',
        'tetangga' => 'Tetangga',
        'rt_rw' => 'Ketua RT/RW',
        'lurah' => 'Kepala Desa/Lurah',
        'petugas_rumah_sakit' => 'Petugas Rumah Sakit',
        'teman' => 'Teman',
        'lainnya' => 'Lainnya',
    ]),
                Forms\Components\TextInput::make('alamat_pelapor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_telepon_pelapor')
                    ->tel()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('penduduk.nama')
                ->label('Nama Penduduk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_kematian')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_kematian'),
                Tables\Columns\TextColumn::make('sebab_kematian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tempat_kematian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_kematian')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pelapor')
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
