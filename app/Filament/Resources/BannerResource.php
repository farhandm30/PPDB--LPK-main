<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Banner / Slider';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $inactiveCount = static::getModel()::where('is_active', false)->count();
        return $inactiveCount > 0 ? 'danger' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Panduan Penggunaan Banner')
                    ->schema([
                        Forms\Components\Placeholder::make('banner_guide')
                            ->content('Panduan Ukuran dan Penggunaan Banner')
                            ->extraAttributes(['class' => 'font-medium text-lg']),

                        Forms\Components\Placeholder::make('image_size')
                            ->content('Ukuran optimal gambar banner: 1920 x 1080 piksel (rasio 16:9)')
                            ->extraAttributes(['class' => 'text-sm']),

                        Forms\Components\View::make('filament.components.banner-guide')
                            ->extraAttributes(['class' => 'text-sm']),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Informasi Banner')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Judul utama yang akan ditampilkan pada banner'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Deskripsi singkat (maksimal 500 karakter)')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->required()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->maxSize(2048) // 2MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->helperText('Ukuran optimal: 1920 x 1080 piksel (rasio 16:9). Maksimal 2MB.')
                            ->directory('banners')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Tombol & Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Teks Tombol')
                            ->maxLength(50)
                            ->helperText('Teks yang akan ditampilkan pada tombol (opsional)'),

                        Forms\Components\TextInput::make('button_link')
                            ->label('Link Tombol')
                            ->url()
                            ->maxLength(255)
                            ->helperText('URL yang akan dibuka ketika tombol diklik'),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->helperText('Aktifkan/nonaktifkan banner ini')
                                    ->default(true),

                                Forms\Components\TextInput::make('order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Urutan tampilan banner (angka kecil ditampilkan lebih dulu)'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->height(80)
                    ->disk('public'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Dibuat')
                //     ->dateTime('d M Y')
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),

                // Tables\Columns\TextColumn::make('updated_at')
                //     ->label('Diperbarui')
                //     ->dateTime('d M Y')
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order')
            // ->filters([
            //     Tables\Filters\SelectFilter::make('is_active')
            //         ->label('Status')
            //         ->options([
            //             '1' => 'Aktif',
            //             '0' => 'Tidak Aktif',
            //         ]),
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggleActive')
                        ->label('Toggle Status')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records): void {
                            foreach ($records as $record) {
                                $record->update([
                                    'is_active' => !$record->is_active,
                                ]);
                            }
                        }),
                ]),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
