<?php

namespace App\Http\Livewire\News\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class RestoreNewsAction extends Action
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('news.actions.restore');
    }

    public $icon = 'trash';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('news.dialogs.restore.title'),
            'description' => __('news.dialogs.restore.description', [
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
