<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <form method="GET" enctype="multipart/form-data" action="{{ route('users.ban', $user) }}">
            @csrf
            
            <textarea
                name="content"
                placeholder="{{ __('Reason for ban') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('content') }}</textarea>

            <select name="banDuration" id="">
                <option value=""disabled selected hidden>ban duration</option>
                <option value="7">1 week</option>
                <option value="30">1 month</option>
                <option value="365">1 year</option>
                <option value="2000">permanently</option>
            </select>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
            
            <br>
            <x-primary-button class="mt-4">{{ __('Ban ') }}{{$user->name}}</x-primary-button>
        </form>
    </div>
   
</x-app-layout>