<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomisiliResource\Pages;
use App\Filament\Resources\DomisiliResource\RelationManagers;
use App\Models\Domisili;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Keluarga;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CodeWithKyrian\FilamentDateRange\Tables\Filters\DateRangeFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DomisiliResource extends Resource
{
    protected static ?string $model = Domisili::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

     public static function getNavigationGroup(): ?string
    {
        return 'Administrasi';
    }

    public static function getNavigationLabel(): string
    {
    return 'Surat Keterangan Domisili';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Data Domisili';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_surat')
                    ->required()
                    //  ->placeholder('Contoh: Jl. Melati No. 15 RT 04 RW 02, Desa Mekarjaya')
                    ->maxLength(255),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga')
                ->label('nama_kepala_keluarga')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penduduk.nama')
                ->label('nama_penduduk')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penduduk.pekerjaan')
                    ->label('pekerjaan')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                 DateRangeFilter::make('created_at')
            ->label('Created within'),
            ])
            ->actions([
                Action::make('cetak')
                ->label('Cetak')
                ->icon('heroicon-o-printer')
              ->url(fn (Domisili $record) => route('cetak.domisili', $record->id))
                ->openUrlInNewTab(),
                ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->tooltip('Actions'),
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
            'index' => Pages\ManageDomisilis::route('/'),
        ];
    }
}
