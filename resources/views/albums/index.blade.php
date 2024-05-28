<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg table-view-wrapper">
                <div class="grid justify-items-stretch pt-2 pr-2">
                    @can('create', App\Models\Album::class)
                        <x-wireui-button primary 
                            label="{{ __('albums.actions.create') }}" 
                            href="{{ route('albums.create') }}" 
                            class="justify-self-end" />
                    @endcan
                </div>                
                <livewire:albums.album-grid-view />
            </div>
        </div>
    </div>
</x-app-layout>
