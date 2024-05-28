<?php

namespace App\Http\Livewire\Albums;

use App\Events\NewAlbumEvent;
use App\Events\NewTourEvent;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Album;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AlbumForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;

    public Album $album;
    public Bool $editMode;
    public $image;
    public $imageUrl;
    public $imageExists;

    public function rules(){
        return [
            'album.name' => [
                'required',
                'string',
                'min:2',
                'unique:albums,name' . ($this->editMode ? (',' . $this->album->id) : ''),
            ],
            'album.publicationYear' => [
                'required',
                'numeric',
                'digits:4',
                'gt:1900',
                'max:2200'
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
            'name' => Str::lower(
                __('albums.attributes.name')
            ),
            'productionYear' => Str::lower(
                __('albums.attributes.productionYear')
            ),
            'image' => Str::lower(
                __('albums.attributes.image')),
        ];
    }

    public function mount(Album $album, Bool $editMode)
    {
        $this->album = $album;
        $this->imageChange();
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.albums.album-form');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save(){
        if ($this->editMode) {
            $this->authorize('update', $this->album);
        } else {
            $this->authorize('create', Album::class);
        }
        $this->validate();
        
        
        $album = $this->album;
        $image = $this->image;

        DB::transaction(function () use ($album, $image) {
            $album->save();
            if ($image !== null) {
                $album->image = $album->id
                    . '.' . $this->image->getClientOriginalExtension();
                $album->save();
            }
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->album->image,
                'public'
            );
        }


        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('albums.messages.successes.updated', ['name' => $this->album->name])
                : __('albums.messages.successes.stored', ['name' => $this->album->name]),
        );

        if (!$this->editMode) {
            NewAlbumEvent::dispatch($this->album);
        }

        $this->editMode = true;
        $this->imageChange();
    }

    public function confirmDeleteImage()
    {
        $this->dialog()->confirm([
            'title' => __('albums.dialogs.image_delete.title'),
            'description' => __('albums.dialogs.image_delete.description', [
                'name' => $this->album->name
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

    public function deleteImage()
    {
        if (Storage::disk('public')->delete($this->album->image)) {
            $this->album->image = null;
            $this->album->save();
            $this->imageChange();
            $this->notification()->success(
                $title = __('translation.messages.successes.destroyed_title'),
                $description = __('albums.messages.successes.image_deleted', [
                    'name' => $this->album->name
                ])
            );
            return;
        }
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('albums.messages.errors.image_deleted', [
                'name' => $this->album->name
            ])
        );
    }

    protected function imageChange()
    {
        $this->imageExists = $this->album->imageExists();
        $this->imageUrl = $this->album->imageUrl();
    }
}
