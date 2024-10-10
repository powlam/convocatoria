<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('New meeting') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create a new meeting.') }}
        </p>
    </header>

    <form wire:submit="storeNewMeeting" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="block w-full mt-1" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="date" :value="__('When?')" />
            <x-text-input wire:model="date" id="date" name="date" type="date" class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('date')" />
        </div>

        <div>
            <x-input-label for="time" :value="__('At what time?')" />
            <x-text-input wire:model="time" id="time" name="time" type="time" class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('time')" />
        </div>

        <div>
            <x-input-label for="where" :value="__('Where?')" />
            <x-text-input wire:model="where" id="where" name="where" type="text" class="block w-full mt-1" />
            <x-input-error class="mt-2" :messages="$errors->get('where')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>

            <x-action-message class="me-3" on="meeting-created">
                {{ __('Created.') }}
            </x-action-message>
        </div>
    </form>
</section>
