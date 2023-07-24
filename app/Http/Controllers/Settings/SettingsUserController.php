<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\ViewModels\Settings\User\SettingsUserViewModel;
use App\Models\User;
use App\Services\DestroyUser;
use App\Services\InviteUser;
use App\Services\UpdateUserPermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class SettingsUserController extends Controller
{
    public function index(): View
    {
        $viewModel = SettingsUserViewModel::index(auth()->user());

        return view('settings.user.index', ['view' => $viewModel]);
    }

    public function create(): Response
    {
        return Inertia::render('Settings/Personalize/Users/Create', [
            'data' => SettingsUserViewModel::index(auth()->user()),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        (new InviteUser)->execute([
            'author_id' => auth()->user()->id,
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'data' => route('settings.personalize.user.index'),
        ], 201);
    }

    public function edit(Request $request, User $user): Response
    {
        return Inertia::render('Settings/Personalize/Users/Edit', [
            'data' => SettingsUserViewModel::edit($user),
        ]);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        (new UpdateUserPermission)->execute([
            'author_id' => auth()->user()->id,
            'user_id' => $user->id,
            'permissions' => $request->input('permissions'),
        ]);

        return response()->json([
            'data' => route('settings.personalize.user.index'),
        ], 200);
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
