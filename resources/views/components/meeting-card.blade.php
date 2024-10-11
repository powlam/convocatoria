@props(['meeting'])

<div class="px-4 py-2 border border-gray-200 rounded-md shadow-md meeting-card">
    <h3 class="font-bold"><a href="{{ $meeting->url }}" class="hover:underline">{{ $meeting->name }}</a></h3>
    @if ($meeting->when)
        <p class="text-sm cursor-default opacity-40 hover:opacity-100">
            <x-icons.calendar class="inline-block" />
            {{ $meeting->when->format('Y-m-d H:i') }}
        </p>
    @endif
    @if ($meeting->where)
        <p class="text-sm cursor-default opacity-40 hover:opacity-100">
            <x-icons.map-pin class="inline-block" />
            {{ $meeting->where }}
        </p>
    @endif
    <!-- TODO show number of accepted and rejected -->
    <!-- TODO edit & delete meeting in a modal window -->
</div>
