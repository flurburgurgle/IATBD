<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="GET" enctype="multipart/form-data" action="{{ route('tools.allTools') }}">
            @csrf
            <textarea
                name="search"
                placeholder="{{ __('Search for tools') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name') }}</textarea>
            <p>Select a category:</p>
            <select name="category" >
                <option value="{{ $currentCategory }}" selected disabled hidden>{{ $currentCategory }}</option>
                <option value="none" >none</option>
                @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('search')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Refine results') }}</x-primary-button>
        </form>
        

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($tools as $tool)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('users.index', $tool->user)}}">
                                    <span class="text-gray-800">{{ $tool->user->name }}</span>
                                </a>                                
                                <small class="ml-2 text-sm text-gray-600">{{ $tool->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($tool->created_at->eq($tool->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <form method="POST" action="{{ route('tools.loans.store', $tool) }}">
                                        @csrf
                                        <x-dropdown-link :href="route('tools.loans.store', $tool)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Loan tool') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                            
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->name }}</p>
                        <img src="{{ asset('images/' . $tool->image->url) }}" alt=""/>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->description}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   
</x-app-layout>