<?php

namespace App\Http\Livewire\Tours\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RestoreTourAction extends Action
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('tours.actions.restore');
    }

    public $icon = 'trash';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('tours.dialogs.restore.title'),
            'description' => __('tours.dialogs.restore.description', [
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
