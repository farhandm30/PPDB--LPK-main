<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Pengaturan Akun';

    protected static ?string $navigationGroup = 'Pengaturan Sistem';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\Section::make('Informasi Pengguna')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create'),
                        Forms\Components\Toggle::make('is_admin')
                            ->label('Admin')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_admin')
                    ->label('Admin')
                    ->placeholder('Semua Pengguna')
                    ->trueLabel('Hanya Admin')
                    ->falseLabel('Bukan Admin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pengguna')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data user ini? Semua data terkait (berkas, orangtua wali, pendaftaran, dan siswa) juga akan dihapus.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->after(function (User $record) {
                        // Check if user has siswa
                        if ($record->siswa) {
                            $siswa = $record->siswa;

                            // Delete berkas if exists
                            if ($siswa->berkas) {
                                $siswa->berkas->delete();
                            }

                            // Delete orangtua_wali if exists
                            if ($siswa->orangtuaWali) {
                                $siswa->orangtuaWali->delete();
                            }

                            // Delete the siswa record
                            $siswa->delete();
                        }

                        // Delete pendaftaran if exists
                        if ($record->pendaftaran) {
                            $record->pendaftaran->delete();
                        }

                        Notification::make()
                            ->title('Pengguna dan semua data terkait berhasil dihapus')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pengguna')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data user ini? Semua data terkait (berkas, orangtua wali, pendaftaran, dan siswa) juga akan dihapus.')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                // Check if user has siswa
                                if ($record->siswa) {
                                    $siswa = $record->siswa;

                                    // Delete berkas if exists
                                    if ($siswa->berkas) {
                                        $siswa->berkas->delete();
                                    }

                                    // Delete orangtua_wali if exists
                                    if ($siswa->orangtuaWali) {
                                        $siswa->orangtuaWali->delete();
                                    }

                                    // Delete the siswa record
                                    $siswa->delete();
                                }

                                // Delete pendaftaran if exists
                                if ($record->pendaftaran) {
                                    $record->pendaftaran->delete();
                                }
                            }

                            Notification::make()
                                ->title('Pengguna dan semua data terkait berhasil dihapus')
                                ->success()
                                ->send();
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
