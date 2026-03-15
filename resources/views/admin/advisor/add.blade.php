<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> <!-- Reduced the container width -->
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">Create Advisor</h3>

                    <form method="POST" action="{{ route('admin.advisor.store') }}" class="mt-6 max-w-lg mx-auto">
                        @csrf

                        <!-- Advisor ID -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="user_avatar">Upload file</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="user_avatar_help" id="user_avatar" type="file">
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">A profile
                                picture is useful to confirm your are logged into your account</div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                Create Advisor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
