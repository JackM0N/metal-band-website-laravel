<?php

namespace App\Http\Livewire\Songs\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class SoftDeletesSongAction extends Action{
    public $title = '';

    public function __construct(){
        parent::__construct();
        $this->title = __('songs.actions.destroy');
    }

    public $icon = 'trash-2';

    public function handle($model, View $view)
    {
        $view->dialog()->confirm([
            'title' => __('songs.dialogs.soft_deletes.title'),
            'description' => __('songs.dialogs.soft_deletes.description', [
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