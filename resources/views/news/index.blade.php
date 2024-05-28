<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.news') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                @can('create', App\Models\News::class)
                        <x-wireui-button primary 
                            label="{{ __('news.actions.create') }}" 
                            href="{{ route('news.create') }}" 
                            class="justify-self-end" />
                @endcan
                </div>
                <livewire:news.news-grid-view />
            </div>
        </div>
    </div>
</x-app-layout>
