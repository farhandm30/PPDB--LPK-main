<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Artikel';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $draftCount = static::getModel()::where('is_published', false)->count();
        return $draftCount > 0 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Informasi Artikel')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $state, Forms\Set $set) =>
                                        $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Article::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan')
                                    ->rows(3)
                                    ->maxLength(255),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Konten')
                                    ->required()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('articles/attachments')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Gambar')
                            ->schema([
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Gambar Utama')
                                    ->image()
                                    ->disk('public')
                                    ->directory('articles/featured')
                                    ->maxSize(2048)
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->imageResizeTargetWidth('1200')
                                    ->imageResizeTargetHeight('675'),
                            ]),

                        Forms\Components\Section::make('Status Publikasi')
                            ->schema([
                                Forms\Components\Toggle::make('is_published')
                                    ->label('Publikasikan')
                                    ->default(false),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now())
                                    ->required()
                                    ->visible(fn(Forms\Get $get) => $get('is_published')),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn() => asset('images/placeholder.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_published')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Dibuat')
                //     ->dateTime('d M Y H:i')
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),

                // Tables\Columns\TextColumn::make('updated_at')
                //     ->label('Diperbarui')
                //     ->dateTime('d M Y H:i')
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publikasikan')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (array $records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'is_published' => true,
                                    'published_at' => $record->published_at ?? now(),
                                ]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('unpublish')
                        ->label('Batalkan Publikasi')
                        ->icon('heroicon-o-x-circle')
                        ->action(function (array $records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'is_published' => false,
                                ]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}