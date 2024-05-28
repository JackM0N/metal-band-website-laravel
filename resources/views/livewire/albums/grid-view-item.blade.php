@props([
'image' => '',
'name' => '',
'publicationYear' => '',
'withBackground' => false,
'model',
'actions' => [],
'hasDefaultAction' => false,
'selected' => false
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  @if ($hasDefaultAction)
  <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
    <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-md square object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
  </a>
  @else
  <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
    <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md square object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
  </a>
  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-gray-900">
          @if ($hasDefaultAction)
          <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
            {!! $name !!}
          </a>
          @else
          {!! $name !!}
          @endif
        </h3>
        <span class="text-sm text-gray-600">
          {{ __('albums.attributes.publicationYear') }}: {!! $publicationYear !!}
        </span>
      </div>

      @if (count($actions))
      <div class="flex justify-end items-center">
        <x-lv-actions.drop-down :actions="$actions" :model="$model" />
      </div>
      @endif
    </div>
  </div>

</div>