<?php

namespace  App\Http\Livewire\Songs\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;
use Illuminate\Support\Facades\Redirect;

class ShowSpotifySongAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "";

    public function __construct(){
        parent::__construct();
        $this->title = __('songs.actions.spotify');
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "music";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $spotify = 'https://open.spotify.com/search/' . $model->title;
        return Redirect::to($spotify);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('viewAny', $model);
    }
}
