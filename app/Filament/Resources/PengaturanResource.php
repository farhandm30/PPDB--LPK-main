<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanResource\Pages;
use App\Filament\Resources\PengaturanResource\RelationManagers;
use App\Models\Pengaturan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaturanResource extends Resource
{
    protected static ?string $model = Pengaturan::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Aplikasi';

    protected static ?string $navigationGroup = 'Pengaturan Sistem';

    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = true;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return '1';
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Aplikasi')
                    ->schema([
                        Forms\Components\TextInput::make('nama_aplikasi')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('nama_instansi')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\Textarea::make('alamat_instansi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('notlp_instansi')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('email_instansi')
                            ->required()
                            ->email()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('website')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Logo')
                    ->schema([
                        Forms\Components\FileUpload::make('logo_persegi')
                            ->image()
                            ->directory('logo')
                            ->required(),

                    ])->columns(1),

                Forms\Components\Section::make('Pengaturan PPDB')
                    ->schema([
                        Forms\Components\Select::make('status_pendaftaran')
                            ->label('Status Pendaftaran')
                            ->options([
                                'buka' => 'Buka',
                                'tutup' => 'Tutup',
                            ])
                            ->default('buka')
                            ->required()
                            ->helperText('Mengatur apakah pendaftaran siswa baru sedang dibuka atau ditutup')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('kota')
                            ->label('Kota/Kabupaten')
                            ->maxLength(50)
                            ->helperText('Digunakan untuk dokumen dan surat resmi'),
                    ]),

                Forms\Components\Section::make('Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('fb_instansi')
                            ->label('Facebook')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('x_instansi')
                            ->label('X / Twitter')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('instagram_instansi')
                            ->label('Instagram')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('youtube_instansi')
                            ->label('Youtube')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('tiktok_instansi')
                            ->label('TikTok')
                            ->maxLength(50),
                    ])->columns(2),

                Forms\Components\Section::make('Profil')
                    ->schema([
                        Forms\Components\Textarea::make('tentang_kami')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('sejarah')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('visi')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('misi')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\Textarea::make('meta_keyword')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('meta_deskripsi')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_aplikasi'),
                Tables\Columns\TextColumn::make('nama_instansi'),
                Tables\Columns\TextColumn::make('notlp_instansi'),
                Tables\Columns\TextColumn::make('email_instansi'),
                Tables\Columns\TextColumn::make('website')
                    ->url(fn($record) => $record->website ? 'https://' . $record->website : null)
                    ->openUrlInNewTab(),
                Tables\Columns\ImageColumn::make('logo_persegi'),
                Tables\Columns\TextColumn::make('kota'),
                Tables\Columns\TextColumn::make('status_pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'buka' => 'success',
                        'tutup' => 'danger',
                    }),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            // ->filters([
            //     //
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaturans::route('/'),
            'edit' => Pages\EditPengaturan::route('/{record}/edit'),
        ];
    }
}
