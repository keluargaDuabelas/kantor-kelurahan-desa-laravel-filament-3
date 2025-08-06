<?php

namespace App\Filament\Resources\KelahiranRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Keluarga;

class KelahiranRelationManager extends RelationManager
{
    protected static string $relationship = 'kelahiran';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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
