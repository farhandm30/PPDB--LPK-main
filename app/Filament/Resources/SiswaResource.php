<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Siswa';

    protected static ?string $navigationGroup = 'Manajemen PPDB';

    protected static ?int $navigationSort = 2;

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
                Forms\Components\Section::make('Informasi Pendaftaran')
                    ->description('Data siswa yang telah diterima')
                    ->schema([
                        Forms\Components\TextInput::make('no_pendaftaran')
                            ->label('Nomor Pendaftaran')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->helperText('Nomor pendaftaran dari sistem PPDB'),
                        Forms\Components\Select::make('jurusan_pilihan')
                            ->label('Jurusan')
                            ->options(function () {
                                return Jurusan::pluck('nama_jurusan', 'id')->toArray();
                            })
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Diterima' => 'Diterima',
                            ])
                            ->disabled()
                            ->dehydrated()
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Informasi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('nik')
                            ->label('NIK')
                            ->maxLength(30),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir'),
                        Forms\Components\Select::make('agama')
                            ->label('Agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                            ]),
                        Forms\Components\TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('no_hp')
                            ->label('No. HP')
                            ->tel()
                            ->maxLength(30),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Siswa')
                            ->image()
                            ->disk('public')
                            ->directory('siswa/foto')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->imagePreviewHeight('150')
                            ->helperText('Upload foto siswa (JPG, PNG max 2MB)')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Data Orang Tua / Wali')
                    ->description('Informasi lengkap orang tua dan wali siswa')
                    ->relationship('orangtuaWali')
                    ->schema([
                        Forms\Components\Fieldset::make('Data Ayah')
                            ->schema([
                                Forms\Components\TextInput::make('nama_ayah')
                                    ->label('Nama Ayah')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('nik_ayah')
                                    ->label('NIK Ayah')
                                    ->maxLength(16),
                                Forms\Components\DatePicker::make('tgl_lahir_ayah')
                                    ->label('Tanggal Lahir Ayah'),
                                Forms\Components\Select::make('pendidikan_terakhir_ayah')
                                    ->label('Pendidikan Terakhir Ayah')
                                    ->options([
                                        'SD/Sederajat' => 'SD/Sederajat',
                                        'SMP/Sederajat' => 'SMP/Sederajat',
                                        'SMA/Sederajat' => 'SMA/Sederajat',
                                        'D1' => 'D1',
                                        'D2' => 'D2',
                                        'D3' => 'D3',
                                        'D4/S1' => 'D4/S1',
                                        'S2' => 'S2',
                                        'S3' => 'S3',
                                        'Tidak Sekolah' => 'Tidak Sekolah',
                                    ]),
                                Forms\Components\TextInput::make('pekerjaan_ayah')
                                    ->label('Pekerjaan Ayah')
                                    ->maxLength(100),
                                Forms\Components\Select::make('penghasilan_ayah')
                                    ->label('Penghasilan Ayah')
                                    ->options([
                                        '< Rp 1.000.000' => '< Rp 1.000.000',
                                        'Rp 1.000.000 - Rp 3.000.000' => 'Rp 1.000.000 - Rp 3.000.000',
                                        'Rp 3.000.000 - Rp 5.000.000' => 'Rp 3.000.000 - Rp 5.000.000',
                                        'Rp 5.000.000 - Rp 10.000.000' => 'Rp 5.000.000 - Rp 10.000.000',
                                        '> Rp 10.000.000' => '> Rp 10.000.000',
                                    ]),
                            ])->columns(2),

                        Forms\Components\Fieldset::make('Data Ibu')
                            ->schema([
                                Forms\Components\TextInput::make('nama_ibu')
                                    ->label('Nama Ibu')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('nik_ibu')
                                    ->label('NIK Ibu')
                                    ->maxLength(16),
                                Forms\Components\DatePicker::make('tgl_lahir_ibu')
                                    ->label('Tanggal Lahir Ibu'),
                                Forms\Components\Select::make('pendidikan_terakhir_ibu')
                                    ->label('Pendidikan Terakhir Ibu')
                                    ->options([
                                        'SD/Sederajat' => 'SD/Sederajat',
                                        'SMP/Sederajat' => 'SMP/Sederajat',
                                        'SMA/Sederajat' => 'SMA/Sederajat',
                                        'D1' => 'D1',
                                        'D2' => 'D2',
                                        'D3' => 'D3',
                                        'D4/S1' => 'D4/S1',
                                        'S2' => 'S2',
                                        'S3' => 'S3',
                                        'Tidak Sekolah' => 'Tidak Sekolah',
                                    ]),
                                Forms\Components\TextInput::make('pekerjaan_ibu')
                                    ->label('Pekerjaan Ibu')
                                    ->maxLength(100),
                                Forms\Components\Select::make('penghasilan_ibu')
                                    ->label('Penghasilan Ibu')
                                    ->options([
                                        '< Rp 1.000.000' => '< Rp 1.000.000',
                                        'Rp 1.000.000 - Rp 3.000.000' => 'Rp 1.000.000 - Rp 3.000.000',
                                        'Rp 3.000.000 - Rp 5.000.000' => 'Rp 3.000.000 - Rp 5.000.000',
                                        'Rp 5.000.000 - Rp 10.000.000' => 'Rp 5.000.000 - Rp 10.000.000',
                                        '> Rp 10.000.000' => '> Rp 10.000.000',
                                    ]),
                            ])->columns(2),

                        Forms\Components\Fieldset::make('Data Wali (Opsional)')
                            ->schema([
                                Forms\Components\TextInput::make('nama_wali')
                                    ->label('Nama Wali')
                                    ->required(false)
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('nik_wali')
                                    ->label('NIK Wali')
                                    ->required(false)
                                    ->maxLength(16),
                                Forms\Components\DatePicker::make('tgl_lahir_wali')
                                    ->label('Tanggal Lahir Wali')
                                    ->required(false),
                                Forms\Components\Select::make('pendidikan_terakhir_wali')
                                    ->label('Pendidikan Terakhir Wali')
                                    ->required(false)
                                    ->options([
                                        'SD/Sederajat' => 'SD/Sederajat',
                                        'SMP/Sederajat' => 'SMP/Sederajat',
                                        'SMA/Sederajat' => 'SMA/Sederajat',
                                        'D1' => 'D1',
                                        'D2' => 'D2',
                                        'D3' => 'D3',
                                        'D4/S1' => 'D4/S1',
                                        'S2' => 'S2',
                                        'S3' => 'S3',
                                        'Tidak Sekolah' => 'Tidak Sekolah',
                                    ]),
                                Forms\Components\TextInput::make('pekerjaan_wali')
                                    ->label('Pekerjaan Wali')
                                    ->required(false)
                                    ->maxLength(100),
                                Forms\Components\Select::make('penghasilan_wali')
                                    ->label('Penghasilan Wali')
                                    ->required(false)
                                    ->options([
                                        '< Rp 1.000.000' => '< Rp 1.000.000',
                                        'Rp 1.000.000 - Rp 3.000.000' => 'Rp 1.000.000 - Rp 3.000.000',
                                        'Rp 3.000.000 - Rp 5.000.000' => 'Rp 3.000.000 - Rp 5.000.000',
                                        'Rp 5.000.000 - Rp 10.000.000' => 'Rp 5.000.000 - Rp 10.000.000',
                                        '> Rp 10.000.000' => '> Rp 10.000.000',
                                    ]),
                            ])->columns(2),

                        Forms\Components\Fieldset::make('Kontak Orang Tua')
                            ->schema([
                                Forms\Components\Textarea::make('alamat_orangtua')
                                    ->label('Alamat Orang Tua')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('no_hp_orangtua')
                                    ->label('No. HP Orang Tua')
                                    ->tel()
                                    ->maxLength(30),
                            ])->columns(1),
                    ]),

                Forms\Components\Section::make('Berkas Pendukung')
                    ->description('Upload berkas-berkas yang diperlukan untuk pendaftaran')
                    ->relationship('berkas')
                    ->schema([
                        Forms\Components\FileUpload::make('ijazah_terakhir')
                            ->label('Ijazah Terakhir')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/ijazah')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload ijazah terakhir (PDF, JPG, PNG max 5MB)'),

                        Forms\Components\FileUpload::make('ktp_sim_paspor')
                            ->label('KTP/SIM/Paspor')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/identitas')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload KTP/SIM/Paspor (PDF, JPG, PNG max 5MB)'),

                        Forms\Components\FileUpload::make('bukti_pendaftaran')
                            ->label('Bukti Pendaftaran')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/bukti')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload bukti pendaftaran (PDF, JPG, PNG max 5MB)'),

                        Forms\Components\FileUpload::make('surat_pernyataan')
                            ->label('Surat Pernyataan')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/surat')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload surat pernyataan (PDF, JPG, PNG max 5MB)'),

                        Forms\Components\FileUpload::make('berkas_lain_1')
                            ->label('Berkas Lain 1 (Opsional)')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/lain')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload berkas tambahan jika ada (PDF, JPG, PNG max 5MB) - Tidak wajib'),

                        Forms\Components\FileUpload::make('berkas_lain_2')
                            ->label('Berkas Lain 2 (Opsional)')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/lain')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload berkas tambahan jika ada (PDF, JPG, PNG max 5MB) - Tidak wajib'),

                        Forms\Components\FileUpload::make('berkas_lain_3')
                            ->label('Berkas Lain 3 (Opsional)')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/lain')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload berkas tambahan jika ada (PDF, JPG, PNG max 5MB) - Tidak wajib'),

                        Forms\Components\FileUpload::make('berkas_lain_4')
                            ->label('Berkas Lain 4 (Opsional)')
                            ->required(false)
                            ->disk('public')
                            ->directory('berkas/lain')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Upload berkas tambahan jika ada (PDF, JPG, PNG max 5MB) - Tidak wajib'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_pendaftaran')
                    ->label('No. Pendaftaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')
                    ->label('Jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Diterima')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jurusan_pilihan')
                    ->label('Jurusan')
                    ->options(fn() => Jurusan::pluck('nama_jurusan', 'id')->toArray()),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Data Siswa')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data siswa ini? Semua data terkait (berkas, orangtua wali, dan user) juga akan dihapus.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->after(function (Siswa $record) {
                        // Delete berkas if exists
                        if ($record->berkas) {
                            $record->berkas->delete();
                        }

                        // Delete orangtua_wali if exists
                        if ($record->orangtuaWali) {
                            $record->orangtuaWali->delete();
                        }

                        // Get the user associated with this siswa
                        $user = $record->user;

                        // Delete the user if it exists
                        if ($user) {
                            $user->delete();
                        }

                        Notification::make()
                            ->title('Data siswa dan semua data terkait berhasil dihapus')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function (Siswa $record): string {

                        // Format phone number (remove any non-numeric characters and ensure it starts with proper format)
                        $phone = preg_replace('/[^0-9]/', '', $record->no_hp);
                        if (substr($phone, 0, 1) === '0') {
                            $phone = '62' . substr($phone, 1);
                        } elseif (substr($phone, 0, 2) !== '62') {
                            $phone = '62' . $phone;
                        }

                        return 'https://wa.me/' . $phone;
                    })
                    ->openUrlInNewTab()
                    ->visible(fn(Siswa $record): bool => !empty($record->no_hp)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Data Siswa')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data siswa yang dipilih? Semua data terkait (berkas, orangtua wali, pendaftaran, dan user) juga akan dihapus.')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                // Delete berkas if exists
                                if ($record->berkas) {
                                    $record->berkas->delete();
                                }

                                // Delete orangtua_wali if exists
                                if ($record->orangtuaWali) {
                                    $record->orangtuaWali->delete();
                                }

                                // Get the user associated with this siswa
                                $user = $record->user;

                                // Delete the user if it exists
                                if ($user) {
                                    $pendaftaran = $user->pendaftaran;

                                    // Delete pendaftaran if exists
                                    if ($pendaftaran) {
                                        $pendaftaran->delete();
                                    }

                                    // Delete the user
                                    $user->delete();
                                }
                            }

                            Notification::make()
                                ->title('Data siswa dan semua data terkait berhasil dihapus')
                                ->success()
                                ->send();
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
