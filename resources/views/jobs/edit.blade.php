<x-layout>
    <x-slot name="title">Редактировать вакансию</x-slot>
        <div
            class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
            <h2 class="text-4xl text-center font-bold mb-4">
                Редактировать вакансию
            </h2>
            <form
                method="POST"
                action="{{ route('jobs.update', $job->id) }}"
                enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <h2
                    class="text-2xl font-bold mb-6 text-center text-gray-500">
                    Информация о вакансии
                </h2>

            <x-inputs.text id="title" name="title" label="Название вакансии" placeholder="Software Engineer" :value="old('title', $job->title)"/>
            <x-inputs.text-area id="description" name="description" label="Описание" placeholder="Ищем опытного...." :value="old('description', $job->description)"/>
            <x-inputs.text id="salary" name="salary" label="Зарплата" type="number" placeholder="90000" :value="old('salary', $job->salary)" />
            <x-inputs.text-area id="requirements" name="requirements" label="Обязанности" placeholder="Обязанности" :value="old('title', $job->title)" />
            <x-inputs.text-area id="benefits" name="benefits" label="Бенефиты" placeholder="Бенефиты" :value="old('benefits', $job->benefits)" />
            <x-inputs.text id="tags" name="tags" label="Tags" placeholder="coding,development,java,c++" :value="old('tags', $job->tags)" />
            <x-inputs.select id="job_type" name="job_type" label="Тип работы" :value="old('job_type', $job->job_type)" 
                :options="[
                    'Full-Time' => 'Full-Time', 
                    'Part-Time' => 'Part-Time', 
                    'Contract' => 'Contract', 
                    'Temporary' => 'Temporary', 
                    'Internship' => 'Internship', 
                    'Volunteer' => 'Volunteer', 
                    'On-Call' => 'On-Call']" />
            <x-inputs.select id="remote" name="remote" label="Работа удаленная?" :value="old('remote')" :options="[0 => 'Нет', 1 => 'Да']"/>
            <x-inputs.text id="address" name="address" label="Address" placeholder="123 Главный Проспект..." :value="old('address', $job->address)"/>
            <x-inputs.text id="city" name="city" label="City" placeholder="Берлин" :value="old('city', $job->city)"/>
            <x-inputs.text id="region" name="region" label="Region" placeholder="Франфуркт" :value="old('region', $job->region)"/>

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
                        :value="old('zipcode', $job->zipcode)"/>
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Информация о компании
                </h2>

                <x-inputs.text id="company_name" name="company_name" label="Company Name" placeholder="Введите название компании" :value="old('company_name', $job->company_name)"/>
                <x-inputs.text-area id="company_description" name="company_description" label="Описание компании" placeholder="Описание компании" :value="old('company_description', $job->company_description)"/>
                <x-inputs.text id="company_website" type="url" name="company_website" label="Company Website" placeholder="Введите сайт компании" :value="old('company_website', $job->company_website)"/>
                <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone" placeholder="Введите телефон компании" :value="old('contact_phone', $job->contact_phone)"/>
                <x-inputs.text id="contact_email" type="email" name="contact_email" label="Contact Email" placeholder="Введите email компании" :value="old('contact_email', $job->contact_email)"/>
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