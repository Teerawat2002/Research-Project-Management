<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">ยื่นสอบโครงงาน</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Title -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">ชื่อโครงงาน</label>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $proposes->title }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">สมาชิกกลุ่มโครงงาน</label>
                    <ul class="list-disc ml-5 mt-2">
                        @forelse ($members as $member)
                            <li class="text-gray-900 dark:text-white">
                                {{ $member->student->name ?? 'Unknown Student' }}</li>
                        @empty
                            <li class="text-gray-500">ไม่พบสมาชิกในกลุ่มนี้</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Upload File Form -->
                <form method="POST" action="{{ route('student.submission.save', ['id' => $examSubmission->id]) }}" enctype="multipart/form-data"
                    class="mt-8">
                    @csrf
                    <div class="mb-6">
                        <label for="attempt"
                            class="block text-md font-medium text-gray-700 dark:text-gray-300">ครั้งที่สอบ</label>
                        <input type="number" name="attempt" id="attempt" min="1" required
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                    </div>
                    <div class="mb-6">
                        <label for="file" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            อัพโหลดไฟล์โครงงาน
                        </label>
                        <input type="file" name="file" id="file" required accept=".pdf"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">***อัพโหลดไฟล์โครงงานเป็น PDF เท่านั้น***</p>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        บันทึก
                    </button>
                    <button type="button" onclick="window.history.back()"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                        ยกเลิก
                    </button>
                </form>

                {{-- <!-- Display Uploaded File -->
                @if ($filePath ?? false)
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Uploaded File:</h3>
                        @php
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Show Image -->
                            <img src="{{ asset('storage/' . $filePath) }}" alt="Uploaded Image"
                                class="max-w-full h-auto rounded-md">
                        @elseif ($fileExtension === 'pdf')
                            <!-- Show PDF -->
                            <embed src="{{ asset('storage/' . $filePath) }}" type="application/pdf" class="w-full h-96">
                        @else
                            <!-- Show Download Link -->
                            <a href="{{ asset('storage/' . $filePath) }}" target="_blank"
                                class="text-blue-600 dark:text-blue-400 underline">
                                Download File
                            </a>
                        @endif
                    </div>
                @endif --}}

            </div>
        </div>
    </div>
</x-app-layout>
