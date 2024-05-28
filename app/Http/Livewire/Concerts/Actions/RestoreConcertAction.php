<?php

namespace App\Http\Livewire\Concerts\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RestoreConcertAction extends Action
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('concerts.actions.restore');
    }

    public $icon = 'trash';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('concerts.dialogs.restore.title'),
            'description' => __('concerts.dialogs.restore.description', [
                'place' => $model->place
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
