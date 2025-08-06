<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Filament\Resources\PendudukResource\RelationManagers;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Keluarga;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CodeWithKyrian\FilamentDateRange\Tables\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static ?string $navigationIcon = 'heroicon-c-identification';

    public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
    return 'Data Penduduk';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Penduduk';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('keluarga_id')
                ->label('Nomor Kepala keluarga')
                ->required()
                ->options(Keluarga::all()->pluck('nomor_kepala_keluarga', 'id'))
                ->searchable()
                ->columnSpan(2)
             ->afterStateUpdated(fn ($state, callable $set) =>
        $set('nama_kepala_keluarga', Keluarga::find($state)?->nama_kepala_keluarga)
    )
    ->reactive(),
     Forms\Components\TextInput::make('nama_kepala_keluarga')
    ->label('nama_kepala_keluarga')
    ->disabled()
    ->dehydrated(false) // Agar tidak disimpan ke database jika tidak diperlukan
    ->columnSpan(2),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status_perkawinan')
                ->label('Status')
     ->required()
                ->options([
        'belum_menikah' => 'Belum Menikah',
        'sudah_menikah' => 'Sudah Menikah',

    ])
    ->native(false),
                Forms\Components\Select::make('pekerjaan')
                   ->label('Jenis Pekerjaan')
    ->options([
        'Tidak Bekerja' => 'Tidak Bekerja',
        'Pelajar/Mahasiswa' => 'Pelajar/Mahasiswa',
        'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
        'PNS' => 'Pegawai Negeri Sipil (PNS)',
        'TNI' => 'TNI',
        'POLRI' => 'POLRI',
        'Karyawan Swasta' => 'Karyawan Swasta',
        'Karyawan BUMN' => 'Karyawan BUMN',
        'Wiraswasta' => 'Wiraswasta',
        'Petani' => 'Petani',
        'Nelayan' => 'Nelayan',
        'Guru' => 'Guru',
        'Dosen' => 'Dosen',
        'Dokter' => 'Dokter',
        'Bidan' => 'Bidan',
        'Perawat' => 'Perawat',
        'Pedagang' => 'Pedagang',
        'Tukang Bangunan' => 'Tukang Bangunan',
        'Sopir' => 'Sopir',
        'Montir' => 'Montir',
        'Pekerja Harian Lepas' => 'Pekerja Harian Lepas',
        'Pengacara' => 'Pengacara',
        'Notaris' => 'Notaris',
        'Seniman/Artis' => 'Seniman/Artis',
        'Penata Rias' => 'Penata Rias',
        'Penjahit' => 'Penjahit',
        'Penjaga Toko' => 'Penjaga Toko',
        'Satpam' => 'Satpam',
        'Pekerja Migran' => 'Pekerja Migran',
        'Pensiunan' => 'Pensiunan',
        'Lainnya' => 'Lainnya',
    ])
    ->searchable()
    ->required(),
                Forms\Components\Select::make('agama')
                    ->required()
                    ->options([
        'Islam' => 'Islam',
        'Kristen Protestan' => 'Kristen Protestan',
        'Katolik' => 'Katolik',
        'Hindu' => 'Hindu',
        'Buddha' => 'Buddha',
        'Konghucu' => 'Konghucu',
        'Kepercayaan Terhadap Tuhan YME' => 'Kepercayaan Terhadap Tuhan YME',
    ])
    ->searchable(),
                Forms\Components\Select::make('jenis_kelamin')
                 ->required()
                 ->searchable()
                ->options([
        'laki_laki' => 'Laki-Laki',
        'perempuan' => 'Perempuan',

    ])
    ->native(false),
                Forms\Components\Select::make('pendidikan')
                ->label('Pendidikan Trakhir')
                    ->required()
                     ->options([
        'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
        'Belum Tamat SD/Sederajat' => 'Belum Tamat SD/Sederajat',
        'Tamat SD/Sederajat' => 'Tamat SD/Sederajat',
        'SLTP/Sederajat' => 'SLTP/Sederajat',
        'SLTA/Sederajat' => 'SLTA/Sederajat',
        'D1' => 'Diploma I (D1)',
        'D2' => 'Diploma II (D2)',
        'D3' => 'Diploma III (D3)',
        'D4' => 'Diploma IV (D4)',
        'S1' => 'Sarjana (S1)',
        'S2' => 'Magister (S2)',
        'S3' => 'Doktor (S3)',
        'Pesantren' => 'Pesantren',
        'Sekolah Luar Biasa' => 'Sekolah Luar Biasa',
        'Lainnya' => 'Lainnya',
    ])
    ->searchable(),
                Forms\Components\TextInput::make('rt')
                 ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('rw')
                       ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga')
                ->label('Kepala Keluarga')

                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable(),


                // Tables\Columns\TextColumn::make('pekerjaan')
                //     ->searchable(),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('status_perkawinan')
                    ->searchable(),
                     Tables\Columns\TextColumn::make('agama')
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
            'index' => Pages\ManagePenduduks::route('/'),
        ];
    }
}
