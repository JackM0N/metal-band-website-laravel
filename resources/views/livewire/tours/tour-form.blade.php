<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('tours.labels.edit_form_title') }}
            @else
                {{ __('tours.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">{{ __('tours.attributes.title') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="tour.title" />
            </div>
            <div class="">
                <label for="startDate">{{ __('tours.attributes.startDate') }}</label>
            </div>
            <div class="">
                <x-wireui-datetime-picker placeholder="{{ __('translation.enter') }}" wire:model="tour.startDate" without-time without-timezone/>
            </div>
            <div class="">
                <label for="endDate">{{ __('tours.attributes.endDate') }}</label>
            </div>
            <div class="">
                <x-wireui-datetime-picker placeholder="{{ __('translation.enter') }}" wire:model="tour.endDate" without-time without-timezone/>
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="image">{{ __('tours.attributes.image') }}</label>
            </div>
            <div class="">
                @if ($imageExists)
                    <div class="relative">
                        <img class="w-full" src="{{ $imageUrl }}" alt="{{ $tour->title }}">
                        <div class="absolute right-2 top-2 h-16">
                            <x-wireui-button.circle outline xs secondary icon="trash"
                                wire:click="confirmDeleteImage" />
                        </div>
                    </div>
                @else
                    <x-wireui-input type="file" wire:model="image" />
                @endif
            </div>
        </div>

        <hr class="my-2">
        <div class="flex justify-end pt-2">
            <x-wireui-button href="{{ route('tours.index') }}" secondary class="mr-2"
                label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>
