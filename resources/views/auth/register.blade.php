<x-layout>
    <x-slot name="title">Создать вакансию</x-slot>
        <div
            class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12"
        >
            <h2 class="text-4xl text-center font-bold mb-4">
                Регистрация
            </h2>
            <form
                method="POST"
                action="{{ route('register.store') }}"
                enctype="multipart/form-data"
            >
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Полное имя"/>
            <x-inputs.text id="email" name="email" type="email" placeholder="Email"/>
            <x-inputs.text id="password" name="password" type="password" placeholder="Пароль"/>
            <x-inputs.text id="password_confirmation" type="password" name="password_confirmation" placeholder="Пароль еще раз"/>

                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
                >
                    Сохранить
                </button>
                <p class="mt-4 text-gray-500">
                    У вас уже есть аккаунт?
                    <a class="text-blue-900" href="{{ route('login') }}">Логин</a>
                </p>
            </form>
        </div>
</x-layout>