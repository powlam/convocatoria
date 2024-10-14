<div>
    @foreach ($meeting->attendants as $attendant)
        <div class="flex items-center justify-start gap-2">
            <span class="w-6 text-right cursor-default">{{ $loop->iteration }}</span>
            <x-text-input type="text" wire:model='attendantNames.{{ $loop->index }}'
                wire:keydown.prevent.enter='updateAttendant({{ $attendant->id }}, {{ $loop->index }})'
                wire:blur='updateAttendant({{ $attendant->id }}, {{ $loop->index }})'
                class="block w-full mt-1" />
            <x-icons.trash wire:click='deleteAttendant({{ $attendant->id }})'
                :wire:confirm="__('Delete the attendant?')"
                class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
        </div>
    @endforeach
    <div class="flex items-center justify-start gap-2">
        <span class="w-6 text-right cursor-default">...</span>
        <x-text-input type="text" wire:model='newAttendant'
            wire:keydown.enter='storeAttendant'
            class="block w-full mt-1" />
        <x-icons.plus wire:click='storeAttendant'
            class="cursor-pointer opacity-10 hover:opacity-100 hover:shadow-xl" />
    </div>
</div>
