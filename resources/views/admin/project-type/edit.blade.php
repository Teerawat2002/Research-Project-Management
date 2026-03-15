<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">แก้ข้อมูลประเภทโครงงานวิจัย</h1>

                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="text-red-500 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.project-type.update', $projectType->id) }}" method="POST"
                        class="max-w-sm mx-auto">
                        @csrf
                        @method('PUT')

                        <!-- Project Type Name -->
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อประเภทโครงงานวิจัย</label>
                        <div class="flex">
                            {{-- <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm8-3a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm0 4a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1Z" />
                                </svg>
                            </span> --}}
                            <input type="text" id="name" name="name"
                                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="เช่น Computer Science" required
                                value="{{ old('name', $projectType->name) }}">
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-2">
                                บันทึก
                            </button>
                            <a href="{{ route('admin.project-type.index') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-center">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
