<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" enctype="multipart/form-data" action="{{ route('tools.destroyLoan', $tool) }}">
            @csrf
            @method('DELETE')
            <textarea
                name="content"
                placeholder="{{ __('Write a review for this user') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('content') }}</textarea>


            <x-input-error :messages="$errors->get('content')" class="mt-2" />
            
            <br>
            <x-primary-button class="mt-4">{{ __('Confirm Return') }}</x-primary-button>
        </form>
    </div>
   
</x-app-layout>