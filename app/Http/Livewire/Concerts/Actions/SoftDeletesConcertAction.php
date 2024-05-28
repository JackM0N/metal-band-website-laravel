<?php

namespace App\Http\Livewire\Concerts\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeletesConcertAction extends Action{
    public $title = '';

    public function __construct(){
        parent::__construct();
        $this->title = __('concerts.actions.destroy');
    }

    public $icon = 'trash-2';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('concerts.dialogs.soft_deletes.title'),
            'description' => __('concerts.dialogs.soft_deletes.description', [
                'place' => $model->place
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