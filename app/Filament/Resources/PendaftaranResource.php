<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Berkas;
use App\Models\OrangtuaWali;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Data Pendaftaran';

    protected static ?string $navigationGroup = 'Manajemen PPDB';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_pendaftaran', '!=', 'Diterima')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function boot()
    {
        parent::boot();

        static::getModel()::with(['user', 'jurusan', 'tahunAjaran']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pendaftaran')
                    ->schema([
                        Forms\Components\TextInput::make('no_daftar')
                            ->label('Nomor Pendaftaran')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('Otomatis')
                            ->helperText('Nomor akan diisi otomatis jika dibiarkan kosong'),
                        Forms\Components\DatePicker::make('tgl_daftar')
                            ->label('Tanggal Daftar')
                            ->required(),
                        Forms\Components\Select::make('id_jurusan')
                            ->label('Jurusan')
                            ->relationship('jurusan', 'nama_jurusan')
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('id_tahun_ajaran')
                            ->label('Tahun Ajaran')
                            ->relationship('tahunAjaran', 'nama_tahun_ajaran')
                            ->required()
                            ->searchable(),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_siswa')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('nik_siswa')
                            ->label('NIK')
                            ->maxLength(30),
                        Forms\Components\Select::make('jk_siswa')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        Forms\Components\TextInput::make('tempat_lahir_siswa')
                            ->label('Tempat Lahir')
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('tgl_lahir_siswa')
                            ->label('Tanggal Lahir'),
                        Forms\Components\Select::make('agama_siswa')
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
                            ->maxLength(100),
                        Forms\Components\TextInput::make('email_siswa')
                            ->label('Email')
                            ->email()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('nohp_siswa')
                            ->label('No. HP')
                            ->tel()
                            ->maxLength(30),
                        Forms\Components\Textarea::make('alamat_siswa')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Orang Tua')
                    ->schema([
                        // Ayah
                        Forms\Components\Fieldset::make('Data Ayah')
                            ->schema([
                                Forms\Components\TextInput::make('nik_ayah')
                                    ->label('NIK Ayah')
                                    ->maxLength(30),
                                Forms\Components\TextInput::make('nama_ayah')
                                    ->label('Nama Ayah')
                                    ->maxLength(100),
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
                                    ->maxLength(30),
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

                        // Ibu
                        Forms\Components\Fieldset::make('Data Ibu')
                            ->schema([
                                Forms\Components\TextInput::make('nik_ibu')
                                    ->label('NIK Ibu')
                                    ->maxLength(30),
                                Forms\Components\TextInput::make('nama_ibu')
                                    ->label('Nama Ibu')
                                    ->maxLength(100),
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
                                    ->maxLength(30),
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

                        // Wali
                        Forms\Components\Fieldset::make('Data Wali (Opsional)')
                            ->schema([
                                Forms\Components\TextInput::make('nik_wali')
                                    ->label('NIK Wali')
                                    ->required(false)
                                    ->maxLength(30),
                                Forms\Components\TextInput::make('nama_wali')
                                    ->label('Nama Wali')
                                    ->required(false)
                                    ->maxLength(100),
                                Forms\Components\DatePicker::make('tgl_lahir_wali')
                                    ->label('Tanggal Lahir Wali')
                                    ->required(false),
                                Forms\Components\Select::make('pendidikan_terakhir_wali')
                                    ->label('Pendidikan Terakhir Wali')
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
                                    ])
                                    ->required(false),
                                Forms\Components\TextInput::make('pekerjaan_wali')
                                    ->label('Pekerjaan Wali')
                                    ->required(false)
                                    ->maxLength(30),
                                Forms\Components\Select::make('penghasilan_wali')
                                    ->label('Penghasilan Wali')
                                    ->options([
                                        '< Rp 1.000.000' => '< Rp 1.000.000',
                                        'Rp 1.000.000 - Rp 3.000.000' => 'Rp 1.000.000 - Rp 3.000.000',
                                        'Rp 3.000.000 - Rp 5.000.000' => 'Rp 3.000.000 - Rp 5.000.000',
                                        'Rp 5.000.000 - Rp 10.000.000' => 'Rp 5.000.000 - Rp 10.000.000',
                                        '> Rp 10.000.000' => '> Rp 10.000.000',
                                    ])
                                    ->required(false),
                            ])->columns(2),

                        // Contact information
                        Forms\Components\Fieldset::make('Informasi Kontak')
                            ->schema([
                                Forms\Components\Textarea::make('alamat_orangtua')
                                    ->label('Alamat Orang Tua')
                                    ->rows(3),
                                Forms\Components\TextInput::make('no_hp_orangtua')
                                    ->label('No. HP Orang Tua')
                                    ->tel()
                                    ->maxLength(15),
                            ])->columns(1),
                    ]),

                Forms\Components\Section::make('Berkas Pendaftaran')
                    ->description('Upload foto siswa dan berkas persyaratan')
                    ->schema([
                        // Foto Siswa
                        Forms\Components\FileUpload::make('foto_siswa')
                            ->label('Upload Foto Siswa')
                            ->nullable()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->disk('public')
                            ->directory('siswa/foto')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->image()
                            ->imagePreviewHeight('250')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('3:4')
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->disabled()
                            ->helperText('📸 Foto diupload oleh siswa. Klik untuk download/view')
                            ->columnSpanFull(),

                        // Dokumen Persyaratan
                        Forms\Components\FileUpload::make('ijazah_terakhir')
                            ->label('Ijazah Terakhir')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/ijazah')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa. Klik untuk download/view'),

                        Forms\Components\FileUpload::make('ktp_sim_paspor')
                            ->label('KTP/SIM/Paspor')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/identitas')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa. Klik untuk download/view'),

                        Forms\Components\FileUpload::make('bukti_pendaftaran')
                            ->label('Bukti Pendaftaran')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/bukti_pendaftaran')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File dibuat otomatis oleh sistem. Klik untuk download/view'),

                        Forms\Components\FileUpload::make('surat_pernyataan')
                            ->label('Surat Pernyataan')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/surat_pernyataan')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa. Klik untuk download/view'),

                        // Berkas Tambahan (Opsional)
                        Forms\Components\FileUpload::make('berkas_lain_1')
                            ->label('Berkas Lain 1 (Opsional)')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/lainnya')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa (opsional). Klik untuk download/view'),

                        Forms\Components\FileUpload::make('berkas_lain_2')
                            ->label('Berkas Lain 2 (Opsional)')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/lainnya')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa (opsional). Klik untuk download/view'),

                        Forms\Components\FileUpload::make('berkas_lain_3')
                            ->label('Berkas Lain 3 (Opsional)')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/lainnya')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa (opsional). Klik untuk download/view'),

                        Forms\Components\FileUpload::make('berkas_lain_4')
                            ->label('Berkas Lain 4 (Opsional)')
                            ->nullable()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048)
                            ->disk('public')
                            ->directory('siswa/berkas/lainnya')
                            ->visibility('public')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->disabled()
                            ->helperText('📄 File diupload oleh siswa (opsional). Klik untuk download/view'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('status_data_diri')
                                    ->label('Status Data Diri')
                                    ->options([
                                        'Belum Lengkap' => 'Belum Lengkap',
                                        'Lengkap' => 'Lengkap',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('status_data_orangtua')
                                    ->label('Status Data Orang Tua')
                                    ->options([
                                        'Belum Lengkap' => 'Belum Lengkap',
                                        'Lengkap' => 'Lengkap',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('status_berkas')
                                    ->label('Status Berkas')
                                    ->options([
                                        'Belum Lengkap' => 'Belum Lengkap',
                                        'Lengkap' => 'Lengkap',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('status_pendaftaran')
                                    ->label('Status Pendaftaran')
                                    ->options([
                                        'Menunggu Verifikasi' => 'Menunggu Verifikasi',
                                        'Diterima' => 'Diterima',
                                        'Dicadangkan' => 'Dicadangkan',
                                        'Ditolak' => 'Ditolak',
                                    ])
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('status_pendaftaran', '!=', 'Diterima'))
            ->columns([
                Tables\Columns\TextColumn::make('no_daftar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nik_siswa')
                    ->label('NIK')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jurusan.nama_jurusan')
                    ->label('Jurusan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahunAjaran.nama_tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nohp_siswa')
                    ->label('No. HP')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status_berkas')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Belum Lengkap' => 'warning',
                        'Lengkap' => 'success',
                    })
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('berkas_count')
                    ->label('Berkas Terupload')
                    ->getStateUsing(function ($record) {
                        $files = collect([
                            'foto_siswa' => $record->foto_siswa,
                            'ijazah_terakhir' => $record->ijazah_terakhir,
                            'ktp_sim_paspor' => $record->ktp_sim_paspor,
                            'bukti_pendaftaran' => $record->bukti_pendaftaran,
                            'surat_pernyataan' => $record->surat_pernyataan,
                        ])->filter();

                        return $files->count() . '/5';
                    })
                    ->badge()
                    ->color(function ($state) {
                        $count = (int) explode('/', $state)[0];
                        return match (true) {
                            $count >= 4 => 'success',
                            $count >= 2 => 'warning',
                            default => 'danger'
                        };
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status_pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Menunggu Verifikasi' => 'warning',
                        'Diterima' => 'success',
                        'Dicadangkan' => 'info',
                        'Ditolak' => 'danger',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_daftar')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pendaftaran')
                    ->options([
                        'Menunggu Verifikasi' => 'Menunggu Verifikasi',
                        'Dicadangkan' => 'Dicadangkan',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->label('Status')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('status_berkas')
                    ->options([
                        'Belum Lengkap' => 'Belum Lengkap',
                        'Lengkap' => 'Lengkap',
                    ])
                    ->label('Status Berkas')
                    ->multiple(),
                Tables\Filters\SelectFilter::make('id_jurusan')
                    ->label('Jurusan')
                    ->options(fn() => Jurusan::pluck('nama_jurusan', 'id')->toArray())
                    ->multiple(),
                Tables\Filters\SelectFilter::make('id_tahun_ajaran')
                    ->label('Tahun Ajaran')
                    ->options(fn() => TahunAjaran::pluck('nama_tahun_ajaran', 'id')->toArray())
                    ->multiple(),
                Tables\Filters\Filter::make('tgl_daftar')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_daftar', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_daftar', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pendaftaran')
                    ->modalDescription('Apakah Anda yakin ingin menghapus pendaftaran ini? Semua data terkait (siswa, berkas, orangtua wali, dan user) juga akan dihapus.')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal')
                    ->after(function (Pendaftaran $record) {
                        // Get the user associated with this pendaftaran
                        $user = $record->user;

                        // If there's a user and the user has a siswa record
                        if ($user && $user->siswa) {
                            $siswa = $user->siswa;

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

                        // Delete the user if it exists
                        if ($user) {
                            $user->delete();
                        }

                        Notification::make()
                            ->title('Data pendaftaran dan semua data terkait berhasil dihapus')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(function (Pendaftaran $record): string {
                        $message = "Halo {$record->nama_siswa},\n\n";
                        $message .= "Ini adalah informasi pendaftaran PPDB Anda:\n";
                        $message .= "No. Pendaftaran: {$record->no_daftar}\n";
                        $message .= "Status: {$record->status_pendaftaran}\n";

                        if ($record->status_pendaftaran == 'Diterima') {
                            $message .= "\nSelamat! Anda diterima. Silahkan cetak bukti pendaftaran dan ikuti petunjuk selanjutnya.";
                        } elseif ($record->status_pendaftaran == 'Dicadangkan') {
                            $message .= "\nPendaftaran Anda masuk ke dalam daftar cadangan. Silahkan tunggu informasi lebih lanjut dari panitia.";
                        } elseif ($record->status_pendaftaran == 'Ditolak') {
                            $message .= "\nMohon maaf, pendaftaran Anda tidak dapat diterima. Silahkan hubungi panitia untuk informasi lebih lanjut.";
                        } else {
                            $message .= "\nPendaftaran Anda sedang dalam proses verifikasi. Pastikan semua data dan berkas sudah lengkap.";
                        }

                        $message .= "\n\nTerima kasih.";

                        // Format phone number (remove any non-numeric characters and ensure it starts with proper format)
                        $phone = preg_replace('/[^0-9]/', '', $record->nohp_siswa);
                        if (substr($phone, 0, 1) === '0') {
                            $phone = '62' . substr($phone, 1);
                        } elseif (substr($phone, 0, 2) !== '62') {
                            $phone = '62' . $phone;
                        }

                        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('verify')
                        ->label('Terima')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Pendaftaran $record): void {
                            try {
                                // Check if a Siswa record already exists for this user or pendaftaran number
                                $existingSiswa = null;
                                if ($record->user_id) {
                                    $existingSiswa = Siswa::where('user_id', $record->user_id)
                                        ->orWhere('no_pendaftaran', $record->no_daftar)
                                        ->first();
                                } else {
                                    $existingSiswa = Siswa::where('no_pendaftaran', $record->no_daftar)
                                        ->first();
                                }

                                if (!$existingSiswa) {
                                    // Buat record baru di tabel Siswa
                                    $siswa = Siswa::create([
                                        'no_pendaftaran' => $record->no_daftar,
                                        'nama_lengkap' => $record->nama_siswa,
                                        'nik' => $record->nik_siswa,
                                        'jenis_kelamin' => $record->jk_siswa,
                                        'tempat_lahir' => $record->tempat_lahir_siswa,
                                        'tanggal_lahir' => $record->tgl_lahir_siswa,
                                        'agama' => $record->agama_siswa,
                                        'asal_sekolah' => $record->asal_sekolah,
                                        'email' => $record->email_siswa,
                                        'no_hp' => $record->nohp_siswa,
                                        'alamat' => $record->alamat_siswa,
                                        'foto' => $record->foto_siswa,
                                        'jurusan_pilihan' => $record->id_jurusan,
                                        'status' => 'Diterima',
                                        'user_id' => $record->user_id,
                                    ]);

                                    // Update status pendaftaran menjadi Diterima (tidak dihapus)
                                    $record->status_pendaftaran = 'Diterima';
                                    $record->save();

                                    Notification::make()
                                        ->title('Data berhasil dipindahkan ke Data Siswa')
                                        ->body('Pendaftaran telah diterima dan data siswa telah dibuat.')
                                        ->success()
                                        ->send();
                                } else {
                                    // Just update the status if the Siswa already exists
                                    $record->status_pendaftaran = 'Diterima';
                                    $record->save();

                                    Notification::make()
                                        ->title('Status pendaftaran berhasil diubah menjadi Diterima')
                                        ->body('Siswa sudah ada dalam database.')
                                        ->success()
                                        ->send();
                                }
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Gagal memproses penerimaan')
                                    ->body('Terjadi kesalahan: ' . $e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran !== 'Diterima'),
                    Tables\Actions\Action::make('reject')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function (Pendaftaran $record): void {
                            $record->status_pendaftaran = 'Ditolak';
                            $record->save();

                            Notification::make()
                                ->title('Status pendaftaran berhasil diubah menjadi Ditolak')
                                ->success()
                                ->send();
                        })
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran !== 'Ditolak'),
                    Tables\Actions\Action::make('cadangkan')
                        ->label('Cadangkan')
                        ->icon('heroicon-o-bookmark')
                        ->color('info')
                        ->action(function (Pendaftaran $record): void {
                            $record->status_pendaftaran = 'Dicadangkan';
                            $record->save();

                            Notification::make()
                                ->title('Status pendaftaran berhasil diubah menjadi Dicadangkan')
                                ->success()
                                ->send();
                        })
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran !== 'Dicadangkan'),
                    Tables\Actions\Action::make('verifikasi')
                        ->label('Menunggu Verifikasi')
                        ->icon('heroicon-o-clipboard-document-check')
                        ->color('warning')
                        ->action(function (Pendaftaran $record): void {
                            $record->status_pendaftaran = 'Menunggu Verifikasi';
                            $record->save();

                            Notification::make()
                                ->title('Status pendaftaran berhasil diubah menjadi Menunggu Verifikasi')
                                ->success()
                                ->send();
                        })
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran !== 'Menunggu Verifikasi'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Pendaftaran')
                        ->modalDescription('Apakah Anda yakin ingin menghapus data pendaftaran ini? Semua data terkait (siswa, berkas, orangtua wali, dan user) juga akan dihapus.')
                        ->modalSubmitActionLabel('Ya, Hapus')
                        ->modalCancelActionLabel('Batal')
                        ->after(function (Collection $records) {
                            foreach ($records as $record) {
                                // Get the user associated with this pendaftaran
                                $user = $record->user;

                                // If there's a user and the user has a siswa record
                                if ($user && $user->siswa) {
                                    $siswa = $user->siswa;

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

                                // Delete the user if it exists
                                if ($user) {
                                    $user->delete();
                                }
                            }

                            Notification::make()
                                ->title('Data pendaftaran dan semua data terkait berhasil dihapus')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('verifySelected')
                        ->label('Terima yang dipilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $successCount = 0;
                            $errorCount = 0;

                            foreach ($records as $record) {
                                try {
                                    // Check if a Siswa record already exists for this user or pendaftaran number
                                    $existingSiswa = null;
                                    if ($record->user_id) {
                                        $existingSiswa = Siswa::where('user_id', $record->user_id)
                                            ->orWhere('no_pendaftaran', $record->no_daftar)
                                            ->first();
                                    } else {
                                        $existingSiswa = Siswa::where('no_pendaftaran', $record->no_daftar)
                                            ->first();
                                    }

                                    if (!$existingSiswa) {
                                        // Buat record baru di tabel Siswa
                                        $siswa = Siswa::create([
                                            'no_pendaftaran' => $record->no_daftar,
                                            'nama_lengkap' => $record->nama_siswa,
                                            'nik' => $record->nik_siswa,
                                            'jenis_kelamin' => $record->jk_siswa,
                                            'tempat_lahir' => $record->tempat_lahir_siswa,
                                            'tanggal_lahir' => $record->tgl_lahir_siswa,
                                            'agama' => $record->agama_siswa,
                                            'asal_sekolah' => $record->asal_sekolah,
                                            'email' => $record->email_siswa,
                                            'no_hp' => $record->nohp_siswa,
                                            'alamat' => $record->alamat_siswa,
                                            'foto' => $record->foto_siswa,
                                            'jurusan_pilihan' => $record->id_jurusan,
                                            'status' => 'Diterima',
                                            'user_id' => $record->user_id,
                                        ]);

                                        // Update status pendaftaran menjadi Diterima (tidak dihapus)
                                        $record->status_pendaftaran = 'Diterima';
                                        $record->save();
                                        $successCount++;
                                    } else {
                                        // Just update the status if the Siswa already exists
                                        $record->status_pendaftaran = 'Diterima';
                                        $record->save();
                                        $successCount++;
                                    }
                                } catch (\Exception $e) {
                                    $errorCount++;
                                }
                            }

                            if ($successCount > 0) {
                                Notification::make()
                                    ->title("Berhasil memindahkan {$successCount} data ke Data Siswa")
                                    ->success()
                                    ->send();
                            }

                            if ($errorCount > 0) {
                                Notification::make()
                                    ->title("Gagal memproses {$errorCount} data")
                                    ->danger()
                                    ->send();
                            }
                        }),
                    Tables\Actions\BulkAction::make('rejectSelected')
                        ->label('Tolak yang dipilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function (Collection $records): void {
                            foreach ($records as $record) {
                                $record->status_pendaftaran = 'Ditolak';
                                $record->save();
                            }

                            Notification::make()
                                ->title('Status pendaftaran yang dipilih berhasil diubah menjadi Ditolak')
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
            'index' => Pages\ListPendaftarans::route('/'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
