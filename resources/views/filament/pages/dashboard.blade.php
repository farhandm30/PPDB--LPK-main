<x-filament-panels::page>
    <div class="flex flex-col gap-y-6">
        @if ($this->hasHeader())
            <div class="flex flex-col gap-y-4">
                @if ($header = $this->getHeader())
                    {{ $header }}
                @elseif ($heading = $this->getHeading())
                    <x-filament-panels::header :actions="$this->getHeaderActions()">
                        <x-slot name="heading">
                            {{ $heading }}
                        </x-slot>

                        <x-slot name="subheading">
                            {{ $this->getSubheading() }}
                        </x-slot>
                    </x-filament-panels::header>
                @endif

                <div class="p-4 bg-white rounded-xl shadow-sm dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="p-2 bg-primary-100 rounded-lg dark:bg-primary-900">
                            <x-heroicon-o-chart-bar-square class="w-6 h-6 text-primary-600 dark:text-primary-400" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold tracking-tight sm:text-xl">
                                Selamat Datang di Dashboard PPDB
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Pantau dan kelola proses penerimaan peserta didik baru dengan mudah melalui dashboard interaktif ini.
                            </p>
                        </div>
                    </div>
                </div>

                @if ($headerWidgets = $this->getHeaderWidgets())
                    <x-filament-widgets::widgets
                        :columns="$this->getHeaderWidgetsColumns()"
                        :widgets="$headerWidgets"
                        :data="$this->getWidgetData()"
                    />
                @endif
            </div>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.start', scopes: $this->getRenderHookScopes()) }}

        {{ $slot }}

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::page.end', scopes: $this->getRenderHookScopes()) }}

        @if ($footerWidgets = $this->getFooterWidgets())
            <x-filament-widgets::widgets
                :columns="$this->getFooterWidgetsColumns()"
                :widgets="$footerWidgets"
                :data="$this->getWidgetData()"
            />
        @endif

        @if (($footer = $this->getFooter()) && ($this->hasFooter()))
            {{ $footer }}
        @endif
    </div>

    <script>
        // Custom script to ensure charts are properly rendered
        document.addEventListener('DOMContentLoaded', function() {
            // Add any custom dashboard JavaScript here
        });
    </script>
</x-filament-panels::page> 