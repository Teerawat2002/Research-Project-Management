<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">แก้ไขรายวิชา</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.course.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    ชื่อรายวิชา
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}"
                    placeholder="เช่น วิชาโครงงาน 1" required
                    class="w-full p-2 mb-4 border border-gray-300 rounded-lg
                           focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                {{-- <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    สถานะ
                </label>
                <select id="status" name="status"
                    class="w-full p-2 mb-4 border border-gray-300 rounded-lg
                           focus:ring-blue-500 focus:border-blue-500
                           dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="1" {{ old('status', $course->status) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !old('status', $course->status) ? 'selected' : '' }}>Inactive</option>
                </select> --}}

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-2">
                        บันทึก
                    </button>
                    <a href="{{ route('admin.course.index') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
