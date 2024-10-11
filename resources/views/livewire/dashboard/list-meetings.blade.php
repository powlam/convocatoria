<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Meetings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Your current meetings.') }}
        </p>
    </header>

    <ul class="mt-6 space-y-4">
        @foreach ($meetings as $meeting)
            <li>
                <x-meeting-card :meeting="$meeting" />
            </li>
        @endforeach
    </ul>
</section>
