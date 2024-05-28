<?php

namespace App\Http\Livewire\Tours;

use App\Models\Tour;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\GridView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Tours\Actions\EditTourAction;
use App\Http\Livewire\Tours\Actions\RestoreTourAction;
use App\Http\Livewire\Tours\Actions\SoftDeletesTourAction;

class ToursGridView extends GridView
{
    use Actions;

    protected $model = Tour::class;
    public $maxCols = 2;
    public $cardComponent = 'livewire.tours.grid-view-item';

    public $searchBy = [
        'title', 
        'startDate', 
        'endDate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function repository(): Builder
    {
        $query = Tour::query();

        if(auth()->user()->isAdmin()){
            $query->withTrashed();
        }
        return $query;
    }

    public function card($model){
        return [
            'image' => $model->imageUrl(),
            'title' => $model->title,
            'startDate' => $model->startDate,
            'endDate' =>$model->endDate,
        ];
    }

    protected function filters()
    {
        $filters = [];
        if(auth()->user()->isAdmin()){
            $filters = [
                new SoftDeletedFilter
            ];
        }
        return $filters; 
    }

    protected function actionsByRow(){
        return [
            new EditTourAction(
                'tours.edit',
                __('tours.actions.edit')
            ),
            new SoftDeletesTourAction(),
            new RestoreTourAction(),
        ];
    }

    public function softDeletes(int $id)
    {
        $tour = Tour::find($id);
        $tour->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('tours.messages.successes.destroyed', [
                'name' => $tour->name
            ])
        );
    }

    public function restore(int $id)
    {
        $tour = Tour::withTrashed()->find($id);
        $tour->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('tours.messages.successes.restored', [
                'name' => $tour->name
            ])
        );
    }

    public function onCardClick(Tour $tour)
    {
        return redirect()->route('tours.concerts', $tour);
    }
}
