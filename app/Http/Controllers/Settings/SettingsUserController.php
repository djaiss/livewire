<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DestroyUser;
use App\Services\InviteUser;
use App\Services\UpdateUserPermission;
use App\ViewModels\Settings\User\SettingsUserViewModel;
use Illuminate\Http\JsonResponse;
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

        return redirect()->route('settings.user.index');
    }

    public function edit(Request $request, User $user): View
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

        return redirect()->route('settings.user.index');
    }

    public function destroy(Request $request, User $user): JsonResponse
    {
        (new DestroyUser)->execute([
            'author_id' => auth()->user()->id,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'data' => true,
        ], 200);
    }
}
