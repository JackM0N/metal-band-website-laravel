<?php

namespace App\Http\Livewire\Tours;

use App\Events\NewTourEvent;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Tour;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;
class TourForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;

    public Tour $tour;
    public Bool $editMode;

    public $image;

    public $imageUrl;
    public $imageExists;

    public function rules(){
        return [
            'tour.title' => [
                'required',
                'string',
                'min:2',
                'unique:tours,title' . ($this->editMode ? (',' . $this->tour->id) : ''),
            ],
            'tour.startDate' => [
                'required',
                'date'
            ],
            'tour.endDate' => [
                'required',
                'date',
            ],
            'image' => [
                'nullable',
                'image',
                'max:1024',
            ],
        ];
    }

    public function validationAttributes(){
        return [
            'title' => Str::lower(
                __('tours.attributes.title')
            ),
            'startDate' => Str::lower(
                __('tours.attributes.startDate')
            ),
            'endDate' => Str::lower(
                __('tours.attributes.startDate')
            ),
            'image' => Str::lower(
                __('products.attributes.image')
            ),
        ];
    }

    public function mount(Tour $tour, Bool $editMode)
    {
        $this->tour = $tour;
        $this->editMode = $editMode;
        $this->imageChange();
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save(){
        if ($this->editMode) {
            $this->authorize('update', $this->tour);
        } else {
            $this->authorize('create', Tour::class);
        }
        $this->validate();

        $tour = $this->tour;
        $image = $this->image;

        DB::transaction(function () use ($tour, $image) {
            $tour->save();
            if ($image !== null) {
                $tour->image = $tour->id
                    . '.' . $this->image->getClientOriginalExtension();
                $tour->save();
            }
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->tour->image,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('tours.messages.successes.updated', ['title' => $this->tour->title])
                : __('tours.messages.successes.stored', ['title' => $this->tour->title]),
        );

        if (!$this->editMode) {
            NewTourEvent::dispatch($this->tour);
        }

        $this->editMode = true;
        $this->imageChange();
    }

    public function render()
    {
        return view('livewire.tours.tour-form');
    }

    public function confirmDeleteImage()
    {
        $this->dialog()->confirm([
            'title' => __('tours.dialogs.image_delete.title'),
            'description' => __('tours.dialogs.image_delete.description', [
                'name' => $this->tour->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'deleteImage',
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    /**
     * Usunięcie zdjęcia
     *
     * @return void
     */
    public function deleteImage()
    {
        if (Storage::disk('public')->delete($this->tour->image)) {
            $this->tour->image = null;
            $this->tour->save();
            $this->imageChange();
            $this->notification()->success(
                $title = __('translation.messages.successes.destroyed_title'),
                $description = __('tours.messages.successes.image_deleted', [
                    'name' => $this->tour->name
                ])
            );
            return;
        }
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('tours.messages.errors.image_deleted', [
                'name' => $this->tour->name
            ])
        );
    }

    protected function imageChange()
    {
        $this->imageExists = $this->tour->imageExists();
        $this->imageUrl = $this->tour->imageUrl();
    }
}
