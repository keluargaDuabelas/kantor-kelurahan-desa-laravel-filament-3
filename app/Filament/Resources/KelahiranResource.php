<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelahiranResource\Pages;
use App\Filament\Resources\KelahiranResource\RelationManagers;
use App\Models\Kelahiran;
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

class KelahiranResource extends Resource
{
    protected static ?string $model = Kelahiran::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

      public static function getNavigationGroup(): ?string
    {
        return 'Data Master';
    }

    public static function getNavigationLabel(): string
    {
    return 'Data Kelahiran';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Kelahiran';
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
                Forms\Components\TextInput::make('nama_bayi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nama_ibu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir_bayi')
                    ->required(),
                Forms\Components\TimePicker::make('jam_lahir_bayi')
                    ->required(),
                Forms\Components\Select::make('tempat_lahir_bayi')
                    ->required()
                    ->searchable()
                    ->options([
        'rumah' => 'Rumah',
        'rumah_sakit' => 'Rumah Sakit',
        'puskesmas' => 'Puskesmas',
        'klinik' => 'Klinik',
        'bidan' => 'Bidan/Praktek Mandiri',
        'di_perjalanan' => 'Di Perjalanan',
        'lainnya' => 'Lainnya',
    ]),
                Forms\Components\Select::make('jenis_kelamin_bayi')
                    ->required()
                    ->searchable()
                    ->options([
        'laki_laki' => 'Laki-Laki',
        'perempuan' => 'Perempuan',

    ])
    ->native(false),
                Forms\Components\TextInput::make('berat_bayi')

                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('panjang_bayi')

                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->placeholder('Contoh: Jl. Melati No. 15 RT 04 RW 02, Desa Mekarjaya')
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bayi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga')
                ->label('Nama Ayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir_bayi')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_lahir_bayi'),
                Tables\Columns\TextColumn::make('tempat_lahir_bayi')
                    ->searchable(),

            ])
            ->filters([
               DateRangeFilter::make('created_at')
            ->label('Created within'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageKelahirans::route('/'),
        ];
    }
}
