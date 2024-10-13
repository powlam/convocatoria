@use('App\Enums\YesNo')

@php
    $attendantsWillBeAttending = $meeting->attendantsWillBeAttending();
@endphp
<div>
    <div class='flex justify-between px-6 mb-2 text-lg font-bold border-b cursor-default'>
        <div class="flex flex-col items-center text-green-500">
            <div>@lang(YesNo::Yes->name)</div>
            <div>{{ $attendantsWillBeAttending[YesNo::Yes->name] }}</div>
        </div>
        <div class="flex flex-col items-center text-gray-500">
            <div>@lang(YesNo::Unknown->name)</div>
            <div>{{ $attendantsWillBeAttending[YesNo::Unknown->name] }}</div>
        </div>
        <div class="flex flex-col items-center text-red-500">
            <div>@lang(YesNo::No->name)</div>
            <div>{{ $attendantsWillBeAttending[YesNo::No->name] }}</div>
        </div>
    </div>
    @foreach ($meeting->attendants as $attendant)
        <div class='flex justify-between px-2 py-1 rounded-lg cursor-default hover:bg-gray-100'>
            @include('livewire.public-web.button-attendant-answer', ['attendant' => $attendant, 'answer' => true])
            @include('livewire.public-web.button-attendant-answer', ['attendant' => $attendant, 'answer' => null])
            @include('livewire.public-web.button-attendant-answer', ['attendant' => $attendant, 'answer' => false])
        </div>
    @endforeach
</div>
