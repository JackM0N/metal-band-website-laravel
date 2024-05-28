<div class="p-2">
    <form wire:submit.prevent="save">
        <h3 class="text-xl font-semibold leading-tight text-gray-800">
            @if ($editMode)
                {{ __('news.labels.edit_form_title') }}
            @else
                {{ __('news.labels.create_form_title') }}
            @endif
        </h3>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="title">{{ __('news.attributes.title') }}</label>
            </div>
            <div class="">
                <x-wireui-input placeholder="{{ __('translation.enter') }}" wire:model="news.title" />
            </div>
            <div class="">
                <label for="contents">{{ __('news.attributes.contents') }}</label>
            </div>
            <div class="">
                <x-wireui-textarea placeholder="{{ __('translation.enter') }}" wire:model="news.contents" />
            </div>
        </div>

        <hr class="my-2">
        <div class="grid grid-cols-2 gap-2">
            <div class="">
                <label for="image">{{ __('news.attributes.image') }}</label>
            </div>
            <div class="">
                @if ($imageExists)
                    <div class="relative">
                        <img class="w-full" src="{{ $imageUrl }}" alt="{{ $news->title }}">
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
            <x-wireui-button href="{{ route('news.index') }}" secondary class="mr-2"
                label="{{ __('translation.back') }}" />
            <x-wireui-button type="submit" primary label="{{ __('translation.save') }}" spinner />
        </div>
    </form>
</div>
