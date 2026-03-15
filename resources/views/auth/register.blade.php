<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Advisor ID -->
        <div>
            <x-input-label for="a_id" :value="__('Advisor ID')" />
            <x-text-input id="a_id" class="block mt-1 w-full" type="text" name="a_id" :value="old('a_id')" required autofocus autocomplete="a_id" />
            <x-input-error :messages="$errors->get('a_id')" class="mt-2" />
        </div>

        <!-- First Name -->
        <div class="mt-4">
            <x-input-label for="a_fname" :value="__('First Name')" />
            <x-text-input id="a_fname" class="block mt-1 w-full" type="text" name="a_fname" :value="old('a_fname')" required autocomplete="a_fname" />
            <x-input-error :messages="$errors->get('a_fname')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="a_lname" :value="__('Last Name')" />
            <x-text-input id="a_lname" class="block mt-1 w-full" type="text" name="a_lname" :value="old('a_lname')" required autocomplete="a_lname" />
            <x-input-error :messages="$errors->get('a_lname')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="m_id" :value="__('Department (m_id)')" />
            <select id="m_id" name="m_id" class="block mt-1 w-full" required>
                @foreach ($majors as $major)
                    <option value="{{ $major->id }}" {{ old('m_id') == $major->id ? 'selected' : '' }}>
                        {{ $major->m_name }} <!-- แสดงชื่อภาควิชา -->
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('m_id')" class="mt-2" />
        </div>        

        <!-- Advisor Type -->
        <div class="mt-4">
            <x-input-label for="a_type" :value="__('Advisor Type')" />
            <select id="a_type" name="a_type" class="block mt-1 w-full" required>
                <option value="advisor">Advisor</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('a_type')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
