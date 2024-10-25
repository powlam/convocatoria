<div>
    <div class="mt-6">
        @foreach ($meeting->attendants as $attendant)
            <div class="flex items-center justify-start gap-2">
                <span class="w-6 text-right cursor-default">{{ $loop->iteration }}</span>
                <x-text-input type="text" wire:model='attendantNames.{{ $loop->index }}'
                    wire:keydown.prevent.enter='updateAttendant({{ $attendant->id }}, {{ $loop->index }})'
                    wire:blur='updateAttendant({{ $attendant->id }}, {{ $loop->index }})'
                    class="block w-full mt-1" />
                <x-icons.trash wire:click='deleteAttendant({{ $attendant->id }})'
                    class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
            </div>
        @endforeach
        <div class="flex items-center justify-start gap-2">
            <span class="w-6 text-right cursor-default">...</span>
            <x-text-input type="text" wire:model='newAttendant'
                wire:keydown.prevent.enter='storeAttendant'
                class="block w-full mt-1"
                :placeholder="__('convocatoria.New attendant')" />
            <x-icons.plus wire:click='storeAttendant'
                class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
        </div>
    </div>

    @if ($meeting->attendants->isEmpty() && ! $existingGroups->isEmpty())
        <div class="mt-12">
            <x-input-label :value="__('convocatoria.Load group')" />
            <div class="flex items-center gap-2" title='{{ __('convocatoria.Load group') }}'>
                <x-icons.user-group />
                <x-select wire:model='selectedGroup' class="block w-full mt-1 empty:text-red-500" title="">
                    <option value="" disabled>{{ __('convocatoria.Load group') }}</option>
                    @foreach ($existingGroups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </x-select>
                <x-icons.arrow-down-tray wire:click='loadGroup'
                    class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
            </div>
        </div>
    @endif

    @if (! $meeting->attendants->isEmpty())
        <div class="mt-12">
            <div class="flex items-center gap-2 mt-6" title='{{ __('convocatoria.Save as group') }}'>
                <x-icons.user-group />
                <x-text-input wire:model='groupName'
                    wire:keydown.prevent.enter='storeGroup'
                    class="block w-full mt-1" :placeholder="__('convocatoria.Save as group')" title="" />
                <x-icons.arrow-up-tray wire:click='storeGroup'
                    class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
            </div>
            @error('groupName')
                <x-input-error class="my-2" :messages="$errors->get('groupName')" />
                <x-danger-button wire:click='replaceGroup'>Replace previous group</x-danger-button>
            @enderror
        </div>
    @endif
</div>
