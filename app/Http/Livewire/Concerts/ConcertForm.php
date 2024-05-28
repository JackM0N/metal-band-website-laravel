<?php

namespace App\Http\Livewire\Concerts;

use App\Models\Concert;
use App\Models\Tour;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ConcertForm extends Component
{
    use Actions;
    use AuthorizesRequests;

    public Concert $concert;
    public $editMode;
    
    public function rules()
    {
        return [
            'concert.date' => [
                'required',
                'date',
            ],
            'concert.country' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'concert.city' => [
                'required',
                'string',
                'min:2',
                'max:300',
            ],
            'concert.place' => [
                'required',
                'string',
                'min:2',
                'max:300',
            ],
            'concert.tour_id' => [
                'required',
                'integer',
                'exists:tours,id'
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            'date' => Str::lower(__('concerts.attributes.date')),
            'country' => Str::lower(__('concerts.attributes.country')),
            'city' => Str::lower(__('concerts.attributes.city')),
            'place' => Str::lower(__('concerts.attributes.place')),
            'tour_id' => Str::lower(__('concerts.attributes.tour')),
        ];
    }

    public function mount(Concert $concert, Bool $editMode)
    {
        $this->concert = $concert;
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.concerts.concert-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        // autoryzacja poprzez policy
        if ($this->editMode) {
            $this->authorize('update', $this->concert);
        } else {
            $this->authorize('create', Concert::class);
        }
        $this->validate();
        $this->concert->save();
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('concerts.messages.successes.updated', ['place' => $this->concert->place])
                : __('concerts.messages.successes.stored', ['place' => $this->concert->place])
        );
        $this->editMode = true;
    }
}