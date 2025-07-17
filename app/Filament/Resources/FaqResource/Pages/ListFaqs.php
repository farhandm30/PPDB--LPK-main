<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListFaqs extends ListRecords
{
    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua FAQ'),
            'active' => Tab::make('Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make('Tidak Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
        ];
    }
}