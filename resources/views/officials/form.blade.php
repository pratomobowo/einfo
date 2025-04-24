@props(['official' => null])

<form method="POST" action="{{ $official ? route('officials.update', $official) : route('officials.store') }}" class="space-y-6">
    @csrf
    @if($official)
        @method('PUT')
    @endif

    <div>
        <x-input-label for="name" :value="__('Nama')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $official?->name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="position" :value="__('Jabatan')" />
        <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $official?->position)" required autocomplete="position" />
        <x-input-error class="mt-2" :messages="$errors->get('position')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ $official ? __('Update') : __('Simpan') }}</x-primary-button>
        <a href="{{ route('officials.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            {{ __('Batal') }}
        </a>
    </div>
</form> 