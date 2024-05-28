<?php

namespace App\Http\Livewire\Songs;

use App\Http\Livewire\Songs\Actions\ShowSpotifySongAction;
use App\Http\Livewire\Songs\Actions\ShowYTSongAction;
use App\Models\Song;
use Illuminate\Database\Eloquent\SoftDeletes;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedSongFilter;
use App\Http\Livewire\Songs\Actions\EditSongAction;
use App\Http\Livewire\Songs\Actions\SoftDeletesSongAction;
use App\Http\Livewire\Songs\Actions\RestoreSongAction;
use LaravelViews\Data\QueryStringData;



class SongTableView extends TableView
{
    use Actions;

    public $searchBy = [
        'title',
        'duration',
        'album.name',
    ];

    public $album;

    public function mount(QueryStringData $queryStringData){
        parent::mount($queryStringData);
        $this->album = request()->album;
    }

    public function repository(): Builder
    {
        $query = Song::query()
        ->where('album_id', $this->album->id)
        ->with(['album'])
        ->join('albums','songs.album_id','=','albums.id')
        ->select('songs.*','albums.name as albums_name', 'songs.created_at as songs_created_at', 'songs.updated_at as songs_updated_at', 'songs.deleted_at as songs_deleted_at');
        
        if(auth()->user()->isAdmin()){
            $query->withTrashed();
        }

        return $query; 
    }

    public function headers(): array
    {
        if(auth()->user()->isAdmin()){
            $headers = [
                Header::title(__('songs.attributes.title'))->sortBy('title'),
                Header::title(__('songs.attributes.duration'))->sortBy('duration'),
                Header::title(__('songs.attributes.album_name'))->sortBy('albums.name'),
                Header::title(__('translation.attributes.created_at'))->sortBy('songs_created_at'),
                Header::title(__('translation.attributes.updated_at'))->sortBy('songs_updated_at'),
                Header::title(__('translation.attributes.deleted_at'))->sortBy('songs_deleted_at'),
            ];
        }else{
            $headers = [
                Header::title(__('songs.attributes.title'))->sortBy('title'),
                Header::title(__('songs.attributes.duration'))->sortBy('duration'),
            ];
        }

        return $headers; 
    }

    public function row($model): array
    {
        if(auth()->user()->isAdmin()){
            $rows = [
                $model->title,
                $model->duration,
                $model->album->name,
                $model->songs_created_at,
                $model->songs_updated_at,
                $model->songs_deleted_at,
            ];
        }else{
            $rows = [
                $model->title,
                $model->duration,
            ];
        }
        return $rows;
    }

    protected function filters()
    {
        if(auth()->user()->isAdmin()){
            $filters = [
                new SoftDeletedSongFilter
            ];
        }else{
            $filters = [];
        }

        return $filters;
    }

    protected function actionsByRow(){
        return [
            new EditSongAction(
                'songs.edit',
                __('songs.actions.edit')
            ),
            new SoftDeletesSongAction(),
            new RestoreSongAction(),
            new ShowYTSongAction(),
            new ShowSpotifySongAction(),
        ];
    }

    public function softDeletes(int $id){
        $song = Song::find($id);
        $song->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('songs.messages.successes.destroyed', [
                'title' => $song->title
            ])
        );
    }

    public function restore(int $id)
    {
        $song = Song::withTrashed()->find($id);
        $song->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('songs.messages.successes.restored', [
                'title' => $song->title
            ])
        );
    }
}