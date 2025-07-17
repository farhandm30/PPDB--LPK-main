<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\Action;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Manajemen Konten';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Pesan Kontak';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Pesan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pengirim')
                            ->disabled()
                            ->required(),

                        TextInput::make('email')
                            ->label('Email')
                            ->disabled()
                            ->email()
                            ->required(),

                        TextInput::make('subject')
                            ->label('Subjek')
                            ->disabled()
                            ->required(),

                        Textarea::make('message')
                            ->label('Pesan')
                            ->disabled()
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        DateTimePicker::make('read_at')
                            ->label('Dibaca pada')
                            ->disabled(),

                        DateTimePicker::make('created_at')
                            ->label('Dikirim pada')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('read_at')
                    ->label('Status')
                    ->boolean()
                    ->getStateUsing(fn(Contact $record): bool => $record->read_at !== null)
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Subjek')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('read_at')
                    ->label('Dibaca')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')

            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('mark_as_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn(Contact $record) => $record->read_at === null)
                    ->action(fn(Contact $record) => $record->markAsRead()),

                Action::make('mark_as_unread')
                    ->label('Tandai Belum Dibaca')
                    ->icon('heroicon-o-x-mark')
                    ->color('gray')
                    ->visible(fn(Contact $record) => $record->read_at !== null)
                    ->action(fn(Contact $record) => $record->markAsUnread()),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->label('Tandai Dibaca')
                        ->icon('heroicon-o-check')
                        ->action(fn(array $records) => collect($records)->each->markAsRead())
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('markAsUnread')
                        ->label('Tandai Belum Dibaca')
                        ->icon('heroicon-o-x-mark')
                        ->action(fn(array $records) => collect($records)->each->markAsUnread())
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListContacts::route('/'),
            'view' => Pages\ViewContact::route('/{record}'),
        ];
    }
}
