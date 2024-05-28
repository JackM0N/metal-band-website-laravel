<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\GridView;
use LaravelViews\Actions\RedirectAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Filters\SoftDeletedFilter;
use App\Http\Livewire\News\Actions\EditNewsAction;
use App\Http\Livewire\News\Actions\RestoreNewsAction;
use App\Http\Livewire\News\Actions\SoftDeletesNewsAction;

class NewsGridView extends GridView
{
    use Actions;
    protected $model = News::class;
    public $maxCols = 4;
    public $cardComponent = 'livewire.news.grid-view-item';
    public $searchBy = [
        'title',
        'contents',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sortableBy(){
        return[
            'Published' => 'created_at'
        ];
    }

    public function repository(): Builder
    {
        $query = News::query();
        if(auth()->user()->isAdmin()){
            $query->withTrashed();
        }

        return $query;
    }

    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'title' => $model->title,
            'created_at' => $model->created_at
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
            new EditNewsAction(
                'news.edit',
                __('news.actions.edit')
            ),
            new SoftDeletesNewsAction(),
            new RestoreNewsAction(),
        ];
    }

    public function softDeletes(int $id){
        $news = News::find($id);
        $news->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroyed_title'),
            $description = __('news.messages.successes.destroyed', [
                'name' => $news->name
            ])
        );
    }

    public function restore(int $id)
    {
        $news = News::withTrashed()->find($id);
        $news->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restored_title'),
            $description = __('news.messages.successes.restored', [
                'name' => $news->name
            ])
        );
    }
}
