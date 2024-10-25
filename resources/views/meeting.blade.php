<x-public-web-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('convocatoria.Meeting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 space-y-2 bg-white shadow sm:p-8 sm:rounded-lg">
                <h3 class="font-bold border-b cursor-default">{{ $meeting->name }}</h3>
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
            </div>

            <div class="p-4 space-y-2 bg-white shadow sm:p-8 sm:rounded-lg">
                <livewire:public-web.meeting-attendants :meeting="$meeting" />
            </div>

            @auth
                @can('update', $meeting)
                    <div class="p-4 text-center ">
                        <a href="{{ route('meetings.edit', $meeting) }}" class="font-bold cursor-pointer hover:underline">@lang('convocatoria.Edit meeting')</a>
                    </div>
                @endcan
            @endauth
        </div>
    </div>
</x-public-web-layout>
