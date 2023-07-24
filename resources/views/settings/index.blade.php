<x-app-layout>
  <!-- header -->
  <div class="mx-auto mb-6 max-w-4xl px-12 pt-6 sm:px-6 lg:px-8">
    <div class="flex justify-center bg-white px-4 shadow sm:rounded-lg">
      <div class="flex items-center text-center">
        <img class="mr-6 h-24 w-24"
             src="/img/settings.png"
             alt="settings" />
        <p class="text-lg font-bold">{{ __('Account settings') }}</p>
      </div>
    </div>
  </div>

  <div class="pb-12">
    <div class="mx-auto flex max-w-4xl sm:px-6 lg:px-8">
      <div class="w-full space-y-6">
        <div class="bg-white shadow sm:rounded-lg">
          <ul>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:rounded-t-lg hover:bg-slate-50">
              <span class="mr-4 rounded border border-yellow-400 bg-yellow-100 px-1">👥</span>
              <a class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                 href="{{ route('settings.user.index') }}"
                 wire:navigate>{{ __('Add or remove users') }}</a>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:bg-slate-50">
              <span class="mr-4 rounded border border-yellow-400 bg-yellow-100 px-1">🏣</span>
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white">
              {{ __("Update organization's name and description") }}</Link>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:bg-slate-50">
              <span class="mr-4 rounded border border-yellow-400 bg-yellow-100 px-1">👮‍♂️</span>
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white">
              {{ __('Manage roles') }}</Link>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:bg-slate-50">
              <span class="mr-4 rounded border border-yellow-400 bg-yellow-100 px-1">🏢</span>
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                    :href="data.url.offices">{{ __('Manage offices') }}</Link>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:bg-slate-50">
              <div class="mr-3 rounded-lg bg-blue-300 p-2">
                <UserGroupIcon class="h-5 w-5" />
              </div>
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                    :href="data.url.team_types">{{ __('Manage team types') }}</Link>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:bg-slate-50">
              <img class="mr-4 h-20 w-20"
                   src="/img/genders.png"
                   alt="" />
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white">
              {{ __('Manage genders and pronouns') }}</Link>
            </li>
            <li class="flex items-center border-b border-gray-200 px-4 py-2 hover:rounded-t-lg hover:bg-slate-50"
                v-if="data.upgradable">
              <span class="mr-4 rounded border border-yellow-400 bg-yellow-100 px-1">🤑</span>
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                    :href="data.url.upgrade">{{ __('Unlock account') }}</Link>
            </li>
            <li class="flex items-center px-4 py-2 hover:rounded-b-lg hover:bg-slate-50">
              <img class="mr-4 h-20 w-20"
                   src="/img/cancel.png"
                   alt="" />
              <Link class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white">
              {{ __('Delete organization') }}</Link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
