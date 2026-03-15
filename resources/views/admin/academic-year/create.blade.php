<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">เพิ่มปีการศึกษา</h1>

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.academic-year.store') }}" method="POST">
                @csrf

                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    ปีการศึกษา (เช่น 2568)
                </label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M6 2a1 1 0 0 0-1 1v1H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1V3a1 1 0 0 0-1-1H6Zm1 2h6v1H7V4ZM4 8h12v8H4V8Zm2 2v2h2v-2H6Zm6 0v2h2v-2h-2Z" />
                        </svg>
                    </span>
                    <input type="number" id="year" name="year"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="เช่น 2566" required value="{{ old('year') }}" min="2500">
                </div>

                <div class="text-xs text-gray-600 dark:text-gray-300 mt-3 mb-4">
                    * กำหนดเป็นปี พ.ศ. (ต้องมากกว่าหรือเท่ากับ 2500) และห้ามซ้ำ
                </div>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-2">
                        บันทึก
                    </button>
                    <a href="{{ route('admin.academic-year.index') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
