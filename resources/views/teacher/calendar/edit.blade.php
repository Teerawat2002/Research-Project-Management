<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-300 dark:text-white">แก้ไขข้อมูล</h3>
                    <form method="POST" action="{{ route('teacher.calendar.update', $calendar->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <label for="ac_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">ปีการศึกษา</label>
                            <select name="ac_id" id="ac_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="" disabled>เลือกปีการศึกษา</option>
                                @foreach ($academic_years as $year)
                                    <option value="{{ $year->id }}"
                                        {{ $calendar->ac_id == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="start_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">วันที่เริ่ม</label>
                            <input type="date" name="start_date" id="start_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('start_date', $calendar->start_date->format('Y-m-d')) }}">
                        </div>

                        <div class="mt-4">
                            <label for="end_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">วันที่สิ้นสุด</label>
                            <input type="date" name="end_date" id="end_date" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('end_date', $calendar->end_date->format('Y-m-d')) }}">
                        </div>

                        <div class="mt-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">รายการ</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ old('title', $calendar->title) }}">
                        </div>

                        <div class="mt-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">รายละเอียด</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('description', $calendar->description) }}</textarea>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                บันทึก
                            </button>
                            <a href="{{ route('teacher.calendar.index') }}"
                                class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
