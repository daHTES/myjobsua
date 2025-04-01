<x-layout>
    <section class="flex flex-col gap-4 md:flex-row ">

        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                Профиль
            </h3>

            @if ($user->avatar)
            <div class="mt-2 flex justify-center">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 object-cover rounded-full">
            </div>
            @endif
                
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-inputs.text id="name" name="name" label="Имя" value="{{ $user->name }}"/>
                <x-inputs.text id="email" name="email" label="Email" type="email" value="{{ $user->email }}"/>
                <x-inputs.file id="avatar" name="avatar" label="Загрузите Фото"/>

                <button type="submit" class="w-full bg-green-500 text-white hover:bg-green-600 focus:outline-none px-4 py-2 border rounded">Сохранить</button>
            </form>
        </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full">
    <h3 class="text-3xl text-center font-bold mb-4">
        Мои вакансии
    </h3>
    @forelse ( $jobs as $job )
    <div class="flex-justify-between items-center border-b-2 border-gray-200 py-2">
    <div>
            <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
            <p class="text-gray-700">{{ $job->job_type }}</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('jobs.edit', $job->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Ред.</a>
        <!-- Delete Form -->
            <form method="POST" action="{{ route('jobs.destroy', $job->id) }}?from=dashboard" onsubmit="return confirm('Вы точно хотите удалить?')">
                @csrf
                    @method('DELETE')
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm">
                            Удалить
                        </button>
            </form>
        <!-- End Delete Form -->
        </div>
    </div>

    <div class="mt-4 bg-gray-100 p-2">
        <h2 class="text-lg font-semibold mb-2">Резюме отправленные</h2>
        @forelse ($job->applicants as $applicant )
            <div class="py-2">
                <p class="text-gray-800">
                    <strong>Имя:</strong> {{ $applicant->full_name }}
                </p>
                <p class="text-gray-800">
                    <strong>Номер телефона:</strong> {{ $applicant->contact_phone }}
                </p>
                <p class="text-gray-800">
                    <strong>Email:</strong> {{ $applicant->email }}
                </p>
                <p class="text-gray-800">
                    <strong>Сообщение:</strong> {{ $applicant->message }}
                </p>
                <p class="text-gray-800 mt-2">
                    <a href="{{ asset('storage/' . $applicant->resume_path) }}" class="text-blue-500 hover:underline text-sm" download>
                        <i class="fas fa-download"></i> Загрузить Резюме
                    </a>
                </p>
                <form method="POST" action="{{ route('applicant.destroy', $applicant->id) }}" onsubmit="return confirm('Вы уверены, что хотите удалить это резюме?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-trash"></i>Удалить резюме
                            </button>
                </form>
            </div>
        @empty
            <p class="text-gray-700 mb-5">Нет отправленных резюме</p>
        @endforelse
    </div>
    @empty
    <p class="text-gray-700">
        У вас нет списка ваканский
    </p>
    @endforelse
</div>
</section>
<x-bottom-banner />
</x-layout>