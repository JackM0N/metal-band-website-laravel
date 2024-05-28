<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('songs.labels.edit_form_title') }}
            @else
                {{ __('songs.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">{{ __('songs.attributes.title') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="song.title" />
            </div>
            <div class="">
                <label for="duration">{{ __('songs.attributes.duration') }}</label>
            </div>
            <div class="">
                <x-wireui-time-picker placeholder="{{ __('translation.enter') }}" wire:model="song.duration" format="24"/>
            </div>
            <div class="">
                <label for="tour_id">{{ __('songs.attributes.album_name') }}</label>
            </div>
            <div class="">
            <x-wireui-select placeholder="{{ __('translation.select') }}" 
                    wire:model.defer="song.album_id" 
                    :async-data="route('async.albums')" 
                    option-label="name" option-value="id"
                    />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('albums.index') }}" secondary class="mr-2"
                label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>
