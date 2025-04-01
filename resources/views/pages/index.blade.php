<x-layout>
    <h2 class="text-center text-3xl mb-4 font-bold roder border-gray-300 p-3">Добро пожаловать на сайт по поиску работы</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        @forelse ($jobs as $job )
        <div>
            <x-job-card :job="$job"/>
        </div>
        @empty
            <p>Нет больше подходящих ваканский</p>
        @endforelse
    </div>
    <a href="{{ route('jobs.index') }}" class="block text-xl text-center">
        <i class="fa fa-arrow-alt-circle-right"></i>Все вакансии
    </a>
    <x-bottom-banner />
</x-layout>
