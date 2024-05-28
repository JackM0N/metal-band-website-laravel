<?php

namespace App\Http\Livewire\News;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\News;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class NewsForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;

    public News $news;
    public Bool $editMode;
    public $image;

    public $imageUrl;
    public $imageExists;

    public function rules(){
        return [
            'news.title' => [
                'required',
                'string',
                'min:2',
                'unique:news,title' . ($this->editMode ? (',' . $this->news->id) : ''),
            ],
            'news.contents' => [
                'required',
                'string',
                'min:10'
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
                __('news.attributes.title')
            ),
            'contents' => Str::lower(
                __('news.attributes.contents')
            ),
            'image' => Str::lower(
                __('news.attributes.image')),
        ];
    }

    public function mount(News $news, Bool $editMode)
    {
        $this->news = $news;
        $this->imageChange();
        $this->editMode = $editMode;
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save(){
        if ($this->editMode) {
            $this->authorize('update', $this->news);
        } else {
            $this->authorize('create', News::class);
        }
        $this->validate();
        
        $news = $this->news;
        $image = $this->image;

        DB::transaction(function () use ($news, $image) {
            $news->save();
            if ($image !== null) {
                $news->image = $news->id
                    . '.' . $this->image->getClientOriginalExtension();
                $news->save();
            }
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->news->image,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('news.messages.successes.updated', ['title' => $this->news->title])
                : __('news.messages.successes.stored', ['title' => $this->news->title])
        );
        $this->editMode = true;
        $this->imageChange();
    }

    public function render()
    {
        return view('livewire.news.news-form');
    }

    public function confirmDeleteImage()
    {
        $this->dialog()->confirm([
            'title' => __('news.dialogs.image_delete.title'),
            'description' => __('news.dialogs.image_delete.description', [
                'title' => $this->news->title
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
        if (Storage::disk('public')->delete($this->news->image)) {
            $this->news->image = null;
            $this->news->save();
            $this->imageChange();
            $this->notification()->success(
                $title = __('translation.messages.successes.destroyed_title'),
                $description = __('news.messages.successes.image_deleted', [
                    'title' => $this->news->title
                ])
            );
            return;
        }
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('news.messages.errors.image_deleted', [
                'title' => $this->news->title
            ])
        );
    }

    protected function imageChange()
    {
        $this->imageExists = $this->news->imageExists();
        $this->imageUrl = $this->news->imageUrl();
    }
}
