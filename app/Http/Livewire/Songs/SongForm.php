<?php

namespace App\Http\Livewire\Songs;

use App\Models\Song;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SongForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    public Song $song;
    public $editMode;
    
    public function rules()
    {
        return [
            'song.title' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'song.duration' => [
                'required',
            ],
            'song.album_id' => [
                'required',
                'integer',
                'exists:albums,id'
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => Str::lower(__('songs.attributes.title')),
            'duration' => Str::lower(__('songs.attributes.duration')),
            'album_id' => Str::lower(__('songs.attributes.album')),
        ];
    }

    public function mount(Song $song, Bool $editMode)
    {
        $this->song = $song;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.songs.song-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->song);
        } else {
            $this->authorize('create', Song::class);
        }
        $this->validate();
        $this->song->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('songs.messages.successes.updated', ['title' => $this->song->title])
                : __('songs.messages.successes.stored', ['title' => $this->song->title])
        );
        $this->editMode = true;

    }
}