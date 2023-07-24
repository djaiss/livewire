<x-app-layout>
  <!-- header -->
  <div class="mb-6">
    <div class="bg-white px-4 py-2 shadow">
      <!-- Breadcrumb -->
      <nav class="flex py-3 text-gray-700">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}"
              class="text-sm text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
              >{{ __('Home') }}</a>
          </li>
          <li>
            <div class="flex items-center">
              <x-heroicon-s-chevron-right class="mr-2 h-4 w-4 text-gray-400" />
              <a href="{{ route('settings.index') }}"
                class="text-sm text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white"
                >{{ __('Account settings') }}</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <x-heroicon-s-chevron-right class="mr-2 h-4 w-4 text-gray-400" />
              <span class="ml-1 text-sm text-gray-500 dark:text-gray-400 md:ml-2">{{ __('Manage users') }}</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="pb-12">
    <div class="mx-auto flex max-w-5xl sm:px-6 lg:px-8">
      <div class="w-full">
        <div class="bg-white shadow sm:rounded-lg">
          <!-- title -->
          <div class="flex items-center justify-between border-b border-gray-200 px-4 py-2">
            <h2 class="text-lg font-medium text-gray-900">
              {{ __('All the users who have access to this account') }}
            </h2>

            <div>
              <PrimaryLinkButton :href="data.url.invite">{{ __('Invite user') }}</PrimaryLinkButton>
            </div>
          </div>

          <!-- list of users -->
          <ul class="w-full">
            @foreach ($view['users'] as $user)
            <li
              class="group flex items-center justify-between px-6 py-4 hover:bg-slate-50 last:hover:rounded-b-lg">

              <!-- user information -->
              <div class="flex items-center">
                <x-avatar class="mr-4 h-8 w-8 rounded" :data="$user['avatar']" />

                <div class="mr-6 flex flex-col">
                  <!-- name + invitation status -->
                  <div class="flex">
                    <div class="font-bold mr-2">{{ $user['name'] }}</div>
                    @if (! $user['verified'])
                    <span
                      class="flex items-center rounded-lg border border-yellow-300 bg-yellow-50 px-2 py-0 text-xs">
                      <span class="text-yellow-600">{{ __('invited') }}</span>
                    </span>
                    @endif
                  </div>

                  <div class="flex">
                    <div class="mr-4 inline text-sm">
                      <span class="flex items-center">
                        <x-heroicon-s-envelope class="mr-2 h-3 w-3 text-gray-400" />
                        <span>{{ $user['email'] }}</span>
                      </span>
                    </div>
                    <div class="inline text-sm">
                      <span class="flex items-center">
                        <x-heroicon-s-key class="mr-2 h-3 w-3 text-gray-400" />
                        {{ $user['permissions'] }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- menu -->
              <div v-if="user.can_delete" class="">
                <Menu as="div" class="relative text-left">
                  <MenuButton class="">
                    <EllipsisVerticalIcon class="h-5 w-5 cursor-pointer hover:text-gray-500" />
                  </MenuButton>

                  <transition
                    enter-active-class="transition duration-100 ease-out"
                    enter-from-class="transform scale-95 opacity-0"
                    enter-to-class="transform scale-100 opacity-100"
                    leave-active-class="transition duration-75 ease-in"
                    leave-from-class="transform scale-100 opacity-100"
                    leave-to-class="transform scale-95 opacity-0">
                    <MenuItems
                      class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                      <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                          <Link
                            :href="user.url.edit"
                            :class="[
                              active ? 'bg-violet-500 text-white' : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]">
                            {{ __('Edit') }}
                          </Link>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                          <button
                            @click="destroy(user)"
                            :class="[
                              active ? 'bg-violet-500 text-white' : 'text-gray-900',
                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]">
                            {{ __('Delete') }}
                          </button>
                        </MenuItem>
                      </div>
                    </MenuItems>
                  </transition>
                </Menu>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
