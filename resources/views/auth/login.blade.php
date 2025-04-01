<x-layout>
    <x-slot name="title">Создать вакансию</x-slot>
        <div
            class="bg-white rounded-lg shadow-md w-full md:max-w-xl mx-auto mt-12 p-8 py-12"
        >
            <h2 class="text-4xl text-center font-bold mb-4">
                Логин
            </h2>
            <form
                method="POST"
                action="{{ route('login.authenticate') }}"
                enctype="multipart/form-data"
            >
            @csrf
            <x-inputs.text id="email" name="email" type="email" placeholder="Email"/>
            <x-inputs.text id="password" name="password" type="password" placeholder="Пароль"/>

                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
                >
                    Войти
                </button>
                <p class="mt-4 text-gray-500">
                    У вас нет еще аккаунта?
                    <a class="text-blue-900" href="{{ route('register') }}">Логин</a>
                </p>
            </form>
        </div>
</x-layout>