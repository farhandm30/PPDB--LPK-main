<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Notifications\Notification;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_unread')
                ->label('Tandai Belum Dibaca')
                ->icon('heroicon-o-x-mark')
                ->color('gray')
                ->visible(fn() => $this->record->read_at !== null)
                ->action(function () {
                    $this->record->markAsUnread();
                    Notification::make()
                        ->title('Pesan ditandai sebagai belum dibaca')
                        ->success()
                        ->send();
                    $this->redirect(ContactResource::getUrl());
                }),
            Actions\DeleteAction::make(),
        ];
    }

    public function mount(int|string $record): void
    {
        parent::mount($record);

        // Mark the message as read when viewed
        if ($this->record->read_at === null) {
            $this->record->markAsRead();
        }
    }
}