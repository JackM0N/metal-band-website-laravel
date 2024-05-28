<?php

namespace App\Http\Livewire\Albums;

use App\Http\Livewire\Albums\Actions\ShowSpotifyAlbumAction;
use App\Http\Livewire\Albums\Actions\ShowYTAlbumAction;
use App\Http\Livewire\Songs\SongTableView;
use App\Models\Album;
use App\Models\Song;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\GridView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\Albums\Actions\EditAlbumAction;
use App\Http\Livewire\Albums\Actions\RestoreAlbumAction;
use App\Http\Livewire\Albums\Actions\SoftDeletesAlbumAction;



class AlbumGridView extends GridView
{
    use Actions;

    protected $model = Album::class;
    public $maxCols = 3;
    public $cardComponent = 'livewire.albums.grid-view-item';

    public $searchBy = [
        'name',
        'publicationYear',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sortableBy(){
        return[
            'Publication year' => 'publicationYear'
        ];
    }

    public function repository(): Builder
    {
        $query = Album::query(); 

        if(auth()->user()->isAdmin()){
            $query->withTrashed();
        }
        return $query;
    }

    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'name' => $model->name,
            'publicationYear' => $model->publicationYear
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
            new EditAlbumAction(
                'albums.edit',
                __('albums.actions.edit')
            ),
            new SoftDeletesAlbumAction(),
            new RestoreAlbumAction(),
            new ShowYTAlbumAction(),
            new ShowSpotifyAlbumAction(),
        ];
    }

    public function softDeletes(int $id){
        $album = Album::find($id);
        $album->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('albums.messages.successes.destroyed', [
                'name' => $album->name
            ])
        );
    }

    public function restore(int $id)
    {
        $album = Album::withTrashed()->find($id);
        $album->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('albums.messages.successes.restored', [
                'name' => $album->name
            ])
        );
    }

    public function onCardClick(Album $album)
    {
        return redirect()->route('albums.songs', $album);
    }
} 