<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($editMode)
            {{ __('concerts.labels.edit_form_title') }}
            @else
            {{ __('concerts.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="date">{{ __('concerts.attributes.date') }}</label>
            </div>
            <div class="">
                <x-wireui-datetime-picker placeholder="{{ __('translation.enter') }}" wire:model="concert.date" without-time without-timezone/>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="country">{{ __('concerts.attributes.country') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="concert.country" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="city">{{ __('concerts.attributes.city') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="concert.city" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="place">{{ __('concerts.attributes.place') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="concert.place" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="tour_id">{{ __('concerts.attributes.tour') }}</label>
            </div>
            <div class="">
                <x-wireui-select placeholder="{{ __('translation.select') }}" 
                    wire:model.defer="concert.tour_id" 
                    :async-data="route('async.tours')" 
                    option-label="title" option-value="id" />
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('tours.index') }}" 
                secondary class="mr-2" label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>