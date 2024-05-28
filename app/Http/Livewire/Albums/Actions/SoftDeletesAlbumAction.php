<?php

namespace App\Http\Livewire\Albums\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeletesAlbumAction extends Action{
    public $title = '';

    public function __construct(){
        parent::__construct();
        $this->title = __('albums.actions.destroy');
    }

    public $icon = 'trash-2';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('albums.dialogs.soft_deletes.title'),
            'description' => __('albums.dialogs.soft_deletes.description', [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'softDeletes',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('delete', $model);
    }
}