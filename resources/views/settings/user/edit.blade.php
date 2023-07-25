<x-app-layout>
  <!-- header -->
  <div class="mb-12">
    <div class="bg-white px-4 py-2 shadow">

      <!-- Breadcrumb -->
      <nav class="flex py-3 text-gray-700">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a class="text-sm text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
               href="{{ route('dashboard') }}"
               wire:navigate>{{ __('Home') }}</a>
          </li>
          <li>
            <div class="flex items-center">
              <x-heroicon-s-chevron-right class="mr-2 h-4 w-4 text-gray-400" />
              <a class="text-sm text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                 href="{{ route('settings.index') }}"
                 wire:navigate>{{ __('Account settings') }}</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <x-heroicon-s-chevron-right class="mr-2 h-4 w-4 text-gray-400" />
              <a class="text-sm text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                 href="{{ route('settings.user.index') }}"
                 wire:navigate>{{ __('Manage users') }}</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <x-heroicon-s-chevron-right class="mr-2 h-4 w-4 text-gray-400" />
              <span class="ml-1 text-sm text-gray-500 dark:text-gray-400 md:ml-2">{{ __('Invite a new user') }}</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="pb-12">
    <div class="mx-auto max-w-lg overflow-hidden rounded-lg bg-white shadow-md dark:bg-gray-800">
      <form method="POST"
            action="{{ $view['url']['update'] }}">
        @method('PUT')
        @csrf

        <div class="relative border-b px-6 py-4">
          <div class="relative mx-auto mb-4 h-32 w-32 overflow-hidden rounded-full">
            <x-avatar class="w-32"
                      :data="$view['avatar']" />
          </div>
          <h1 class="mb-2 text-center text-lg font-bold">{{ $view['name'] }}</h1>
        </div>

        <div class="relative px-6 py-4">

          <x-input-label class="mb-3"
                         for="last_name"
                         :value="__('What permissions should this person have?')" />

          <div class="space-y-2">
            <div class="flex items-center gap-x-2">
              <input class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                     id="account_manager"
                     name="permissions"
                     type="radio"
                     value="account_manager"
                     {{ $view['permissions'] === 'account_manager' ? 'checked' : '' }} />
              <label class="block text-sm font-medium leading-6 text-gray-900"
                     for="account_manager">{{ __('Account manager') }}</label>
            </div>
            <div class="flex items-center gap-x-2">
              <input class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                     id="administrator"
                     name="permissions"
                     type="radio"
                     value="administrator"
                     {{ $view['permissions'] === 'administrator' ? 'checked' : '' }} />
              <label class="block text-sm font-medium leading-6 text-gray-900"
                     for="administrator">{{ __('Administrator') }}</label>
            </div>
            <div class="flex items-center gap-x-2">
              <input class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                     id="user"
                     name="permissions"
                     type="radio"
                     value="user"
                     {{ $view['permissions'] === 'user' ? 'checked' : '' }} />
              <label class="block text-sm font-medium leading-6 text-gray-900"
                     for="user">{{ __('User') }}</label>
            </div>
          </div>
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between border-t bg-gray-50 px-6 py-4">
          <a class="text-sm font-medium text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
             href="{{ route('settings.user.index') }}"
             wire:navigate>{{ __('Back') }}</a>

          <div>
            <x-primary-button class="w-full text-center">
              {{ __('Save') }}
            </x-primary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
