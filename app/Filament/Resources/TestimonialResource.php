<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?string $navigationLabel = 'Testimonial Siswa';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $inactiveCount = static::getModel()::where('is_active', false)->count();
        return $inactiveCount > 0 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Testimonial')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('role')
                            ->label('Peran/Kelas')
                            ->maxLength(255)
                            ->placeholder('Misalnya: Siswa Kelas XII TKJ'),

                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('testimonials')
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '⭐ (1 Bintang)',
                                2 => '⭐⭐ (2 Bintang)',
                                3 => '⭐⭐⭐ (3 Bintang)',
                                4 => '⭐⭐⭐⭐ (4 Bintang)',
                                5 => '⭐⭐⭐⭐⭐ (5 Bintang)',
                            ])
                            ->default(5)
                            ->required(),

                        Textarea::make('content')
                            ->label('Konten Testimonial')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Testimonial akan ditampilkan berdasarkan urutan dari kecil ke besar'),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Testimonial hanya akan ditampilkan jika status aktif'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Peran/Kelas'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state)),

                TextColumn::make('content')
                    ->label('Testimonial')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
