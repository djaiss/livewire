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
              <span class="ml-1 text-sm text-gray-500 dark:text-gray-400 md:ml-2">{{ __('Delete the user') }}</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="pb-12">
    <div class="mx-auto max-w-lg overflow-hidden rounded-lg bg-white shadow-md dark:bg-gray-800">
      <form method="POST"
            action="{{ $view['url']['destroy'] }}">

        @csrf
        @method('delete')

        <div class="relative border-b px-6 py-4">
          <div class="h-3w-32 relative mx-auto mb-4 w-32 overflow-hidden rounded-full">
            <img class="mx-auto block text-center"
                 src="/img/invite.png"
                 alt="logo" />
          </div>
          <h1 class="text-center text-lg font-bold">{{ __('Delete :name from the system', ['name' => $view['name']]) }}
          </h1>
        </div>

        <div class="relative border-b px-6 py-4">
          <p>
            {{ __('Are you certain? All data inputted by the user will be erased immediately and cannot be recovered.') }}
          </p>
        </div>

        <!-- actions -->
        <div class="flex items-center justify-between bg-gray-50 px-6 py-4">
          <a class="text-sm font-medium text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
             href="{{ route('settings.user.index') }}"
             wire:navigate>{{ __('Back') }}</a>

          <div>
            <x-danger-button class="w-full text-center">
              {{ __('Delete user') }}
            </x-danger-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
