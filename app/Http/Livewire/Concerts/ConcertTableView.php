<?php

namespace App\Http\Livewire\Concerts;

use App\Http\Livewire\Filters\SoftDeletedConcertFilter;
use App\Models\Concert;
use App\Models\Tour;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Concerts\Actions\EditConcertAction;
use App\Http\Livewire\Concerts\Actions\RestoreConcertAction;
use App\Http\Livewire\Concerts\Actions\SoftDeletesConcertAction;
use LaravelViews\Data\QueryStringData;



class ConcertTableView extends TableView
{
    use Actions;

    public $searchBy = [
        'date',
        'country',
        'city',
        'place',
        'tour.title',
    ];

    public function mount(QueryStringData $queryStringData){
        parent::mount($queryStringData);
        $this->tour = request()->tour;
    }

    public function repository(): Builder
    {
        $query = Concert::query()->with(['tour'])
        ->where('tour_id', $this->tour->id)
        ->with(['tour'])
        ->join('tours','concerts.tour_id','=','tours.id')
        ->select('concerts.*','tours.title as tours_title', 'concerts.created_at as concerts_created_at', 'concerts.updated_at as concerts_updated_at', 'concerts.deleted_at as concerts_deleted_at');

        if(auth()->user()->isAdmin()){
            $query->withTrashed();
        }

        return $query;
    }

    public function headers(): array
    {
        if(auth()->user()->isAdmin()){
            $headers = [Header::title(__('concerts.attributes.date'))->sortBy('date'),
            Header::title(__('concerts.attributes.country'))->sortBy('country'),
            Header::title(__('concerts.attributes.city'))->sortBy('city'),
            Header::title(__('concerts.attributes.place'))->sortBy('place'),
            Header::title(__('concerts.attributes.tour'))->sortBy('tours.title'),
            Header::title(__('translation.attributes.created_at'))->sortBy('concerts_created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('concerts_updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('concerts_deleted_at'),];
        }else{
            $headers = [Header::title(__('concerts.attributes.date'))->sortBy('date'),
            Header::title(__('concerts.attributes.country'))->sortBy('country'),
            Header::title(__('concerts.attributes.city'))->sortBy('city'),
            Header::title(__('concerts.attributes.place'))->sortBy('place'),
            ];
        }

        return $headers;
    }

    public function row($model): array
    {
        if(auth()->user()->isAdmin()){
            $row = [
                $model->date,
                $model->country,
                $model->city,
                $model->place,
                $model->tour->title,
                $model->concerts_created_at,
                $model->concerts_updated_at,
                $model->concerts_deleted_at,
            ];
        }else{
            $row = [
                $model->date,
                $model->country,
                $model->city,
                $model->place,
            ];
        }

        return $row;
    }

    protected function filters()
    {
        $filters = [];
        if(auth()->user()->isAdmin()){
            $filters = [
                new SoftDeletedConcertFilter
            ];
        }
        return $filters; 
    }

    protected function actionsByRow(){
        return [
            new EditConcertAction(
                'concerts.edit',
                __('concerts.actions.edit')
            ),
            new SoftDeletesConcertAction(),
            new RestoreConcertAction(),
        ];
    }

    public function softDeletes(int $id){
        $concert = Concert::find($id);
        $concert->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('concerts.messages.successes.destroyed', [
                'place' => $concert->place
            ])
        );
    }

    public function restore(int $id)
    {
        $concert = Concert::withTrashed()->find($id);
        $concert->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('concerts.messages.successes.restored', [
                'place' => $concert->place
            ])
        );
    }
}