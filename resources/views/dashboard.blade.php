<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:dashboard.list-meetings />
                </div>
            </div>

            <x-a-as-primary-button href="{{ route('meetings.create') }}">
                @lang('convocatoria.New meeting')
            </x-a-as-primary-button>
        </div>
    </div>
</x-app-layout>
