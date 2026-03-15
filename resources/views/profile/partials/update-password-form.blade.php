<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('เปลี่ยนรหัสผ่าน') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('ตรวจสอบให้แน่ใจว่าบัญชีของคุณใช้รหัสผ่านแบบสุ่มที่ยาวเพื่อความปลอดภัย') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update.password') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Current Password --}}
        <div>
            <x-input-label for="current_password" :value="__('รหัสผ่านเดิม')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div>
            <x-input-label for="password" :value="__('รหัสผ่านใหม่')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('ยืนยันรหัสผ่านใหม่')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
