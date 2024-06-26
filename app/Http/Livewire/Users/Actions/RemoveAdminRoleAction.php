<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class RemoveAdminRoleAction extends Action
{
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.remove_admin_role');
    }

    public $icon = 'droplet';

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.admin'));
        $this->success(__('users.messages.successes.admin_role_removed'));
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.admin'));
    }
}
