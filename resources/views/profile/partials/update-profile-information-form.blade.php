<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('ข้อมูลโปรไฟล์') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('อัปเดตชื่อและนามสกุลของคุณ') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- First Name --}}
        <div>
            <x-input-label for="fname" :value="__('ชื่อ')" />
            <x-text-input id="fname" name="fname" type="text" class="mt-1 block w-full" :value="old('fname', $user->a_fname ?? $user->s_fname)"
                required />
            <x-input-error :messages="$errors->get('fname')" class="mt-2" />
        </div>

        {{-- Last Name --}}
        <div>
            <x-input-label for="lname" :value="__('นามสกุล')" />
            <x-text-input id="lname" name="lname" type="text" class="mt-1 block w-full" :value="old('lname', $user->a_lname ?? $user->s_lname)"
                required />
            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
