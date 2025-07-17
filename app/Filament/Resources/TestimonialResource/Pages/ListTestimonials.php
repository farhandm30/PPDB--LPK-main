<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Testimoni'),
            'active' => Tab::make('Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
            'inactive' => Tab::make('Tidak Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
        ];
    }
}
