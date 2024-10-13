@props(['attendant', 'answer'])

@php
    $answerText = $answer === true ? 'true' : ($answer === false ? 'false' : 'null');
    $actionText = $answer === true ? 'will attend' : ($answer === false ? 'will not attend' : 'is still uncertain');
@endphp
<button wire:click='storeAttendantAnswer({{ $attendant->id }}, {{ $answerText }})'
    wire:confirm='@lang('Confirm the new answer, please: :name :action', ['name' => $attendant->name, 'action' => $actionText])'
    @disabled($attendant->willBeAttending === $answer)
    @class([
    'font-bold border-2 border-transparent rounded-lg px-2 py-1',
    'text-green-500' => $answer === true && $attendant->willBeAttending === $answer,
    'text-red-500' => $answer === false && $attendant->willBeAttending === $answer,
    'text-gray-500' => $answer === null && $attendant->willBeAttending === $answer,
    'opacity-10 hover:opacity-100' => $attendant->willBeAttending !== $answer,
    'hover:border-green-500 hover:text-green-500' => $answer === true && $attendant->willBeAttending !== $answer,
    'hover:border-red-500 hover:text-red-500' => $answer === false && $attendant->willBeAttending !== $answer,
    'hover:border-gray-500 hover:text-gray-500' => $answer === null && $attendant->willBeAttending !== $answer,
])>
    {{ $attendant->name }}
</button>
