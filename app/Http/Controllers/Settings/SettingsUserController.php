<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DestroyUser;
use App\Services\InviteUser;
use App\Services\UpdateUserPermission;
use App\ViewModels\Settings\User\SettingsUserViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsUserController extends Controller
{
    public function index(): View
    {
        $viewModel = SettingsUserViewModel::index(auth()->user());

        return view('settings.user.index', ['view' => $viewModel]);
    }

    public function create(): View
    {
        return view('settings.user.create');
    }

    public function store(Request $request): RedirectResponse
    {
        (new InviteUser)->execute([
            'author_id' => auth()->user()->id,
            'email' => $request->input('email'),
        ]);

        notify()->success(__('User invited successfully.'));

        return redirect()->route('settings.user.index');
    }

    public function edit(User $user): View
    {
        $viewModel = SettingsUserViewModel::edit($user);

        return view('settings.user.edit', ['view' => $viewModel]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        (new UpdateUserPermission)->execute([
            'author_id' => auth()->user()->id,
            'user_id' => $user->id,
            'permissions' => $request->input('permissions'),
        ]);

        notify()->success(__('Changes saved.'));

        return redirect()->route('settings.user.index');
    }

    public function delete(User $user): View
    {
        $viewModel = SettingsUserViewModel::delete($user);

        return view('settings.user.destroy', ['view' => $viewModel]);
    }

    public function destroy(User $user): RedirectResponse
    {
        (new DestroyUser)->execute([
            'author_id' => auth()->user()->id,
            'user_id' => $user->id,
        ]);

        notify()->success(__('The user has been deleted.'));

        return redirect()->route('settings.user.index');
    }
}
