<?php

namespace App\Http\Livewire\Albums\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RestoreAlbumAction extends Action
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('albums.actions.restore');
    }

    public $icon = 'trash';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('albums.dialogs.restore.title'),
            'description' => __('albums.dialogs.restore.description', [
                'name' => $model->name
            ]),
            'icon' => 'question',
            'iconColor' => 'text-green-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'restore',
                'params' => $model->id,
            ],
            'reject' => [
                'label' => __('translation.no'),
            ],
        ]);
    }

    public function renderIf($model, View $view)
    {
        return request()->user()->can('restore', $model);
    }
}
