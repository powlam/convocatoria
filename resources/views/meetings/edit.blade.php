<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit meeting') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Edit the meeting data and attendants.') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('meetings.update', $meeting) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" required autofocus value="{{ $meeting->name ?? old('name') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                
                        <div>
                            <x-input-label for="date" :value="__('When?')" />
                            <x-text-input id="date" name="date" type="date" class="block w-full mt-1" value="{{ $meeting->date ?? old('date') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>
                
                        <div>
                            <x-input-label for="time" :value="__('At what time?')" />
                            <x-text-input id="time" name="time" type="time" class="block w-full mt-1" value="{{ $meeting->time ?? old('time') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('time')" />
                        </div>
                
                        <div>
                            <x-input-label for="where" :value="__('Where?')" />
                            <x-text-input id="where" name="where" type="text" class="block w-full mt-1" value="{{ $meeting->where ?? old('where') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('where')" />
                        </div>
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Attendants') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Here you can manage the attendants to the meeting.
                    </p>

                    <livewire:dashboard.manage-attendants :meeting="$meeting" />
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Delete meeting') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('It will delete the meeting completely.') }}
                    </p>

                    <form method="POST" action="{{ route('meetings.destroy', $meeting) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center gap-4">
                            <x-danger-button href="{{ route('meetings.destroy', $meeting) }}">{{ __('Delete') }}</x-danger-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
