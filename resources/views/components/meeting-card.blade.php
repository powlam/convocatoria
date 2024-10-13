@props(['meeting'])
@use('App\Enums\YesNo')

<div class="px-4 py-2 space-y-2 border border-gray-200 rounded-md shadow-md meeting-card">
    <h3 class="font-bold border-b cursor-default">{{ $meeting->name }}</h3>
    <div class="flex justify-between">
        <div>
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
        </div>

        <!-- TODO show number of accepted and rejected -->
        @php
            $attendantsWillBeAttending = $meeting->attendantsWillBeAttending();
            $totalAttendants = $attendantsWillBeAttending[YesNo::Yes->name]
                + $attendantsWillBeAttending[YesNo::Unknown->name]
                + $attendantsWillBeAttending[YesNo::No->name];
        @endphp
        <a href="{{ $meeting->url }}" class="p-2 border border-gray-200 rounded-md hover:shadow-xl answers">
            <div class="flex justify-between gap-2">
                <p class="text-green-500">{{ __(YesNo::Yes->name) }} = {{ $attendantsWillBeAttending[YesNo::Yes->name] }}</p>
                <p class="text-gray-500">{{ __(YesNo::Unknown->name) }} = {{ $attendantsWillBeAttending[YesNo::Unknown->name] }}</p>
                <p class="text-red-500">{{ __(YesNo::No->name) }} = {{ $attendantsWillBeAttending[YesNo::No->name] }}</p>
            </div>
            <meter value="{{ $attendantsWillBeAttending[YesNo::Yes->name] }}" min="0" max="{{ $totalAttendants }}" class="w-full">
                {{ $attendantsWillBeAttending[YesNo::Yes->name] }} out of {{ $totalAttendants }}
            </meter>
        </a>
    </div>

    <!-- TODO edit & delete meeting in a modal window -->
</div>
