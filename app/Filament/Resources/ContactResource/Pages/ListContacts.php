<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Contact;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('markAllAsRead')
                ->label('Tandai Semua Dibaca')
                ->icon('heroicon-o-check')
                ->color('success')
                ->action(function () {
                    Contact::whereNull('read_at')->update(['read_at' => now()]);
                    Notification::make()
                        ->title('Semua pesan ditandai sebagai dibaca')
                        ->success()
                        ->send();
                    $this->redirect(ContactResource::getUrl());
                })
                ->visible(fn() => Contact::whereNull('read_at')->count() > 0),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Pesan'),
            'unread' => Tab::make('Belum Dibaca')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNull('read_at')),
            'read' => Tab::make('Dibaca')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('read_at')),
        ];
    }
}
