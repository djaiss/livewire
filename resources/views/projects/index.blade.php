<x-app-layout>
<div class="mx-auto mb-6 max-w-7xl space-y-6 px-12 pt-6 sm:px-6 lg:px-8">
      <div class="bg-white shadow sm:rounded-lg">
        <!-- menu -->
        <div class="px-4">
          <div class="flex items-center justify-between text-center font-medium text-gray-500 dark:text-gray-400">
            <ul class="-mb-px flex flex-wrap">
              <li class="mr-2">
                <a
                  href="#"
                  class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-blue-300 hover:text-blue-600 dark:hover:text-gray-300">
                  {{ __('Your projects') }}
                </a>
              </li>
              <li class="mr-2">
                <a
                  href="#"
                  class="active inline-block rounded-t-lg border-b-2 border-blue-600 p-4 text-blue-600 dark:border-blue-500 dark:text-blue-500">
                  {{ __('Starred projects') }}
                </a>
              </li>
              <li class="mr-2">
                <a
                  href="#"
                  class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-blue-300 hover:text-blue-600 dark:hover:text-gray-300">
                  {{ __('All projects') }}
                </a>
              </li>
            </ul>

            <div v-if="!data.needs_upgrade">
              <PrimaryLinkButton :href="data.url.create">{{ __('Create project') }}</PrimaryLinkButton>
            </div>
            <div v-else>
              <span
                v-tooltip="__('Please upgrade your account to add another project')"
                class="flex cursor-not-allowed rounded-md bg-indigo-500 px-3 py-1.5 font-semibold text-white shadow-sm ring-1 ring-inset ring-indigo-600 hover:bg-indigo-700">
                {{ __('Create project') }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pb-12">
      <div class="mx-auto flex max-w-5xl sm:px-6 lg:px-8">
        <div class="w-full">
          <div class="bg-white shadow sm:rounded-lg">
            <!-- list of projects -->
            <div v-if="props.data.projects.length > 0" class="flex">
              <ul class="w-full">
                @foreach ($view['projects'] as $project)
                <li
                  class="flex items-center justify-between px-6 py-4 hover:bg-slate-100 first:hover:rounded-t-lg last:hover:rounded-b-lg">
                  <!-- project information -->
                  <div class="flex items-center">
                    <div class="mr-6 flex flex-col">
                      <!-- project name -->
                      <div class="flex items-center">
                        <span v-if="!project.is_public" v-tooltip="__('This project is private')">
                          <x-heroicon-s-lock-closed class="mr-2 h-4 w-4 text-blue-500" />
                        </span>
                        <a
                          href="{{ $project['url']['show'] }}"
                          class="text-blue-700 underline hover:rounded-sm hover:bg-blue-700 hover:text-white">
                          {{ $project['name'] }}
                        </a>
                      </div>

                      <!-- description -->
                      @if ($project['description'])
                      <p class="text-sm text-gray-600">{{ $project['description'] }}</p>
                      @endif
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- blank state -->
            @if (count($view['projects']) === 0)
            <div>
              <div class="px-4 py-6 text-center">
                <h3 class="mb-2 text-lg font-medium text-gray-900">{{ __("You haven't started a project yet.") }}</h3>
                <p class="mb-10 text-gray-500">{{ __('Get started by adding your first project.') }}</p>
                <img src="/img/projects.png" class="mx-auto block h-60 w-60" alt="projects" />
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
    </x-app-layout>
