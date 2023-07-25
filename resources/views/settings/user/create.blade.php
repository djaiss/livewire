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
            action="{{ route('settings.user.store') }}">

        @csrf
        <div class="relative border-b px-6 py-4">
          <div class="h-3w-32 relative mx-auto mb-4 w-32 overflow-hidden rounded-full">
            <img class="mx-auto block text-center"
                 src="/img/invite.png"
                 alt="logo" />
          </div>
          <h1 class="mb-2 text-center text-lg font-bold">{{ __('Invite a new user') }}</h1>
          <h3 class="text-center text-sm text-gray-700">{{ __("We'll email this person an invitation.") }}</h3>
        </div>

        <div class="relative border-b px-6 py-4">
          <!-- Name -->

          <x-input-label for="email"
                         :value="__('What is the email address of the person you would like to invite?')" />

          <x-text-input class="mt-1 block w-full"
                        id="email"
                        name="email"
                        type="email"
                        :value="old('email')"
                        required
                        autofocus />

          <x-input-help class="mt-2">
            {{ __('This should be a valid email address.') }}
          </x-input-help>

          <x-input-error class="mt-2"
                         :messages="$errors->get('email')" />
        </div>

        <!-- what happens next -->
        <div class="relative px-6 py-4">
          <div class="flex items-center space-y-2">
            <div class="mr-3 rounded-full">
              <x-heroicon-s-information-circle class="h-7 w-7 text-gray-300" />
            </div>
            <div>
              <p class="mb-2 text-sm font-bold">{{ __('What happens next?') }}</p>
              <p>
                {{ __(
                    'The person will receive an email with instructions to setup the account. The invitation will remain valid for three days.',
                ) }}
              </p>
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
              {{ __('Send') }}
            </x-primary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
