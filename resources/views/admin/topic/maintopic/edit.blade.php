<x-app-layout>
    <div class="mt-16 py-8">
        <div class="p-6 text-gray-900">
            <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">แก้ไขหัวข้อหลัก</h1>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.topic.maintopic.update', $topic->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Edit Topic Name -->
                    <label for="name" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        หัวข้อ
                    </label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ใส่ชื่อหัวข้อ" required value="{{ old('name', $topic->name) }}">

                    <!-- Edit Topic Score -->
                    <label for="score" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        คะแนน
                    </label>
                    <input type="text" id="score" name="score"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ใส่คะแนน" required value="{{ old('score', $topic->score) }}">

                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
                            บันทึก
                        </button>
                        <a class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            href="{{ route('admin.topic.maintopic.index') }}">
                            ยกเลิก
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
