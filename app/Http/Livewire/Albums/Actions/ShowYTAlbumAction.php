<?php

namespace  App\Http\Livewire\Albums\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;
use Illuminate\Support\Facades\Redirect;

class ShowYTAlbumAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "";

    public function __construct(){
        parent::__construct();
        $this->title = __('albums.actions.youtube');
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "youtube";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $yt = 'https://www.youtube.com/results?search_query=' . $model->name;
        return Redirect::to($yt);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('viewAny', $model);
    }
}
