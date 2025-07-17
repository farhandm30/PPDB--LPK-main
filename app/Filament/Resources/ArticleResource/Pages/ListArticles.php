<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Artikel'),
            'published' => Tab::make('Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now())),
            'draft' => Tab::make('Tidak Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('is_published', false)),
        ];
    }
}