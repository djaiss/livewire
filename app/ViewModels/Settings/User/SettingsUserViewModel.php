<?php

namespace App\ViewModels\Settings\User;

use App\Models\User;

class SettingsUserViewModel
{
    public static function index(User $user): array
    {
        $users = User::where('organization_id', $user->organization_id)
            ->get()
            ->map(fn (User $otherUser) => self::dto($user, $otherUser));

        return [
            'users' => $users,
        ];
    }

    public static function dto(User $loggedUser, User $otherUser): array
    {
        $permission = match ($otherUser->permissions) {
            User::ROLE_ACCOUNT_MANAGER => trans('Account manager'),
            User::ROLE_ADMINISTRATOR => trans('Administrator'),
            User::ROLE_USER => trans('User'),
            default => trans('User'),
        };

        return [
            'id' => $otherUser->id,
            'name' => $otherUser->name,
            'avatar' => $otherUser->avatar,
            'email' => $otherUser->email,
            'verified' => $otherUser->email_verified_at !== null,
            'can_delete' => $loggedUser->id !== $otherUser->id,
            'permissions' => $permission,
            'url' => [
                'edit' => route('settings.user.edit', [
                    'user' => $otherUser->id,
                ]),
                'destroy' => route('settings.user.destroy', [
                    'user' => $otherUser->id,
                ]),
            ],
        ];
    }

    public static function edit(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'permissions' => $user->permissions,
            'url' => [
                'update' => route('settings.user.update', [
                    'user' => $user->id,
                ]),
            ],
        ];
    }
}
