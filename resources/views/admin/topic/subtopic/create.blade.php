<x-app-layout>
    <div class="mt-16 py-8">
        <div class="p-6 text-gray-900">
            <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">เพิ่มหัวข้อรอง</h1>

                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.topic.subtopic.store') }}" method="POST">
                    @csrf

                    <!-- เลือกประเภทหัวข้อ -->
                    {{-- <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Select Topic Type
                    </label> --}}

                    <!-- ใส่ชื่อหัวข้อ -->
                    <label for="mtopic_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">เลือกหัวข้อหลัก</label>
                    <select name="mtopic_id" id="mtopic_id"
                        class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        <option value="">เลือกประเภทหัวข้อ</option>
                        @foreach ($main_topics as $main_topic)
                            <option value="{{ $main_topic->id }}">{{ $main_topic->name }}</option>
                        @endforeach
                    </select>

                    <label for="name" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        ชื่อหัวข้อรอง
                    </label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ใส่ชื่อหัวข้อ" required value="{{ old('name') }}">

                    <label for="name" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        คะแนน
                    </label>
                    <input type="text" id="score" name="score"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ใส่คะแนน" required value="{{ old('score') }}">

                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
                            บันทึก
                        </button>
                        <a class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            href="{{ route('admin.topic.subtopic.index') }}">
                            ยกเลิก
                        </a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
