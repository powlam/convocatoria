@use('App\Enums\YesNo')

<div>
    <div class='flex justify-between text-lg font-bold cursor-default'>
        <div>Yes</div>
        <div>?</div>
        <div>No</div>
    </div>
    @php
        $attendantsWillBeAttending = $meeting->attendantsWillBeAttending();
    @endphp
    <div class='flex justify-between mb-2 text-lg font-bold border-b cursor-default'>
        <div>{{ $attendantsWillBeAttending[YesNo::Yes->name] }}</div>
        <div>{{ $attendantsWillBeAttending[YesNo::Unknown->name] }}</div>
        <div>{{ $attendantsWillBeAttending[YesNo::No->name] }}</div>
    </div>
    @foreach ($attendants as $attendant)
        <div @class([
            'flex cursor-default hover:bg-gray-100 px-2 py-1 rounded-lg',
            'justify-start' => $attendant->willBeAttending === true,
            'justify-center' => $attendant->willBeAttending === null,
            'justify-end' => $attendant->willBeAttending === false,
        ])>
            <span @class([
                'font-bold',
                'text-green-500' => $attendant->willBeAttending === true,
                'text-gray-500' => $attendant->willBeAttending === null,
                'text-red-500' => $attendant->willBeAttending === false,
            ])>{{ $attendant->name }}</span>
        </div>
    @endforeach
</div>
<!--
    Allow changing the answer
-->
