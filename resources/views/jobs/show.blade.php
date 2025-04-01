<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <a
                        class="block p-4 text-blue-700"
                        href="{{ route('jobs.index') }}">
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Назад к списку
                    </a>
                    @can('update', $job)
                    <div class="flex space-x-3 ml-4">
                        <a href="{{ route('jobs.edit', $job->id) }}"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                            >Редак.</a>
                        <!-- Delete Form -->
                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" onsubmit="return confirm('Вы точно хотите удалить?')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                Удалить
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                    @endcan
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">
                        {{ $job->title }}
                    </h2>
                    <p class="text-gray-700 text-lg mt-2">
                       {{ $job->description }}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2">
                            <strong>Тип работы:</strong> {{ $job->job_type }}
                        </li>
                        <li class="mb-2">
                            <strong>Удаленная:</strong> {{ $job->remote ? 'Да' : 'Нет' }}
                        </li>
                        <li class="mb-2">
                            <strong>Зарплата:</strong> {{ number_format($job->salary) }}
                        </li>
                        <li class="mb-2">
                            <strong>Локация:</strong> {{ $job->city }}, {{ $job->region }}
                        </li>
                        @if($job->tags)
                        <li class="mb-2">
                            <strong>Теги:</strong> {{ ucwords(str_replace(',', ', ', $job->tags)) }}
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                @if($job->requirements || $job->benefits)
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                <div class="rounded-lg shadow-md bg-white p-4">
                    <h3 class="text-lg font-semibold mb-2 text-blue-500">
                        Требования к вакансии
                    </h3>
                    <p>
                        {{$job->requirements}}
                    </p>
                    <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">
                        Бенефиты
                    </h3>
                    <p>
                        {{ $job->benefits }}
                    </p>
                </div>
                @endif

                @auth
                <p class="my-5">
                    Укажите «Заявление о приеме на работу» в качестве темы письма и прикрепите свое резюме.
                </p>

                <div x-data="{open: false}">
                        <button @click="open = true" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                            Подать заявку
                        </button>

                        <div x-cloak x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                            <div @click.away="open = false " class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                                <h3 class="text-lg font-semibold mb-4">
                                    Для вакансии {{ $job->title }}
                                </h3>
                                <form method="POST" action="{{ route('applicant.store', $job->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <x-inputs.text id="full_name" name="full_name" label="Полное имя" />
                                        <x-inputs.text id="contact_phone" name="contact_phone" label="Телефон" />
                                        <x-inputs.text id="contact_email" name="contact_email" label="Email" :required="true" />
                                        <x-inputs.text-area id="message" name="message" label="Сообщение" />
                                        <x-inputs.text id="location" name="location" label="Локация" />
                                        <x-inputs.file id="resume" name="resume" label="Загрузить ваше резюме PDF" :required="true" />
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                                Отправить резюме
                                        </button>
                                        <button @click="open = false" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded-md">
                                            Отменить
                                    </button>
                                </form>
                            </div>
                        </div>
                </div>
                @else
                <p class="my-5 bg-gray-200 rounded-xl p-3">
                    <i class="fas f-info-circle mr-3"></i>
                    Вы должны зайти в кабинет, чтобы принять эту вакансию
                </p>
                @endauth

            </div>

            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>

        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">
                Информация о компании
            </h3>
            @if($job->company_logo)
            <img
                src="/storage/{{ $job->company_logo }}"
                alt="Ad"
                class="w-full rounded-lg mb-4 m-auto"
            />
            @endif
            <h4 class="text-lg font-bold">{{ $job->company_name }}</h4>
            @if($job->company_description)
            <p class="text-gray-700 text-lg my-3">
                {{ $job->company_description }}
            </p>
            @endif
            @if($job->company_website)
            <a href="{{ $job->company_website }}"
                target="_blank"
                class="text-blue-500"
                >Посетить сайт</a>
                @endif


                @guest
                    <p class="mt-10 bg-gray-200 text-gray-700 font-bold w-full py-2 px-4 rounded-full text-center">
                        <i class="fas fa-info-circle mr-3"></i>Вы должны зайти в свой кабинет!
                    </p>
                @else
                        <form method="POST" action="{{auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists() ? route('bookmarks.destroy', $job->id) : route('bookmarks.store', $job->id) }}" class="mt-10">
                            @csrf
                            @if(auth()->user()->bookmarkedJobs()->where('job_id', $job->id)->exists())
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center">
                                <i class="fas fa-bookmark mr-3"></i>Удалить Вакансию
                            </button>
                            @else
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center">
                                <i class="fas fa-bookmark mr-3"></i>Список Вакансий
                            </button>
                            @endif
                        </form>
                @endguest
            <a
                href=""
                class="mt-10 bg-blue-500 hover:bg-blue-600 text-white font-bold w-full py-2 px-4 rounded-full flex items-center justify-center"
                ><i class="fas fa-bookmark mr-3"></i> Bookmark
                Listing</a
            >
        </aside>
    </div>
</x-layout>

<link
  href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css"
  rel="stylesheet"
/>
<script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Your Mapbox access token
    mapboxgl.accessToken = "{{ env('MAPBOX_API_KEY') }}";

    // Initialize the map
    const map = new mapboxgl.Map({
      container: 'map', // ID of the container element
      style: 'mapbox://styles/mapbox/streets-v11', // Map style
      center: [-74.5, 40], // Default center
      zoom: 9, // Default zoom level
    });

    // Get address from Laravel view
    const city = '{{ $job->city }}';
    const state = '{{ $job->state }}';
    const address = city + ', ' + state;

    // Geocode the address
    fetch(
      `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(
        address
      )}.json?access_token=${mapboxgl.accessToken}`
    )
      .then((response) => response.json())
      .then((data) => {
        if (data.features.length > 0) {
          const [longitude, latitude] = data.features[0].center;

          // Center the map and add a marker
          map.setCenter([longitude, latitude]);
          map.setZoom(14);

          new mapboxgl.Marker().setLngLat([longitude, latitude]).addTo(map);
        } else {
          console.error('No results found for the address.');
        }
      })
      .catch((error) => console.error('Error geocoding address:', error));
  });
</script>
