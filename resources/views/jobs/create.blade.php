<x-layout>
    <x-slot name="title">Создать вакансию</x-slot>
        <div
            class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl"
        >
            <h2 class="text-4xl text-center font-bold mb-4">
                Разместить вакансию
            </h2>
            <form
                method="POST"
                action="{{ route('jobs.store') }}"
                enctype="multipart/form-data"
            >
            @csrf
                <h2
                    class="text-2xl font-bold mb-6 text-center text-gray-500"
                >
                    Информация о вакансии
                </h2>

            <x-inputs.text id="title" name="title" label="Название вакансии" placeholder="Software Engineer"/>
            <x-inputs.text-area id="description" name="description" label="Описание" placeholder="Ищем опытного...."/>
            <x-inputs.text id="salary" name="salary" label="Зарплата" type="number" placeholder="90000"/>
            <x-inputs.text-area id="requirements" name="requirements" label="Обязанности" placeholder="Обязанности"/>
            <x-inputs.text-area id="benefits" name="benefits" label="Бенефиты" placeholder="Бенефиты"/>
            <x-inputs.text id="tags" name="tags" label="Tags" placeholder="coding,development,java,c++"/>
            <x-inputs.select id="job_type" name="job_type" label="Тип работы" value="{{ old('job_type') }}" 
            :options="[
                'Full-Time' => 'Full-Time', 
                'Part-Time' => 'Part-Time', 
                'Contract' => 'Contract', 
                'Temporary' => 'Temporary', 
                'Internship' => 'Internship', 
                'Volunteer' => 'Volunteer', 
                'On-Call' => 'On-Call'
                ]"/>
            <x-inputs.select id="remote" name="remote" label="Работа удаленная?" value="{{ old('remote') }}" :options="[0 => 'Нет', 1 => 'Да']"/>
            <x-inputs.text id="address" name="address" label="Address" placeholder="123 Главный Проспект..."/>
            <x-inputs.text id="city" name="city" label="City" placeholder="Берлин"/>
            <x-inputs.text id="region" name="region" label="Region" placeholder="Франфуркт"/>

                <div class="mb-4">
                    <label class="block text-gray-700" for="zipcode"
                        >ZIP Code</label
                    >
                    <input
                        id="zipcode"
                        type="text"
                        name="zipcode"
                        class="w-full px-4 py-2 border rounded focus:outline-none"
                        placeholder="12201"
                    />
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Информация о компании
                </h2>

                <x-inputs.text id="company_name" name="company_name" label="Company Name" placeholder="Введите название компании"/>
                <x-inputs.text-area id="company_description" name="company_description" label="Описание компании" placeholder="Описание компании"/>
                <x-inputs.text id="company_website" type="url" name="company_website" label="Company Website" placeholder="Введите сайт компании"/>
                <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone" placeholder="Введите телефон компании"/>
                <x-inputs.text id="contact_email" type="email" name="contact_email" label="Contact Email" placeholder="Введите email компании"/>
                <x-inputs.file id="company_logo" name="company_logo" label="Лого компании" />

                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
                >
                    Сохранить
                </button>
            </form>
        </div>
</x-layout>