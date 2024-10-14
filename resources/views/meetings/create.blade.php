<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('New meeting') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create a new meeting.') }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('meetings.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" required autofocus value="{{ old('name') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                
                        <div>
                            <x-input-label for="date" :value="__('When?')" />
                            <x-text-input id="date" name="date" type="date" class="block w-full mt-1" value="{{ old('date') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>
                
                        <div>
                            <x-input-label for="time" :value="__('At what time?')" />
                            <x-text-input id="time" name="time" type="time" class="block w-full mt-1" value="{{ old('time') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('time')" />
                        </div>
                
                        <div>
                            <x-input-label for="where" :value="__('Where?')" />
                            <x-text-input id="where" name="where" type="text" class="block w-full mt-1" value="{{ old('where') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('where')" />
                        </div>
                
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
