<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Tools') }}
        </h2>
    </x-slot>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8 lg:max-w-5xl">
        <form class="max-w-xl container mx-auto" method="GET" enctype="multipart/form-data" action="{{ route('tools.allTools') }}">
            @csrf
            <textarea
                name="search"
                placeholder="{{ __('Search for tools') }}"
                class="resize-none h-11 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm my-2"
            >{{ old('name') }}</textarea>
            <p>Select a category:</p>
            <select name="category" class="mr-2">
                <option value="{{ $currentCategory }}" selected disabled hidden>{{ $currentCategory }}</option>
                <option class="bg-slate-50" value="none">none</option>
                @foreach ($categories as $category)
                <option class="odd:bg-blue-50 even:bg-slate-50" value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('search')" class="mt-2" />
            <x-primary-button class="onClick:animate-spin mt-4 m-2">{{ __('Refine results') }}</x-primary-button>
        </form>
        

        <div class="grid grid-cols-1 max-w-1xl mt-6 lg:grid-cols-3 lg:max-w-4/5">
        @foreach ($tools as $tool)
                <div class="p-0 bg-white shadow-sm m-1 rounded-lg hover:shadow-xl">
                    
                    <div class="flex-1">
                        <div class="bg-blue-100 pt-0.5 rounded-t-lg">
                           <div class="flex justify-between items-center m-2">
                                <div class="w-full">
                                    <img src="{{URL::asset('/images/tag.png')}}" alt="" class="h-6 w-6 text-gray-600 -scale-x-100 float-left mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <span class="mt-4 text-xl font-semibold text-gray-900">{{ $tool->name }}</span>
                                    
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
                            
                                    
                                    <br>
                                    <small class="ml-4 text-sm text-gray-600">added on: {{ $tool->created_at->format('j M Y') }}</small>
                                    @unless ($tool->created_at->eq($tool->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                    <a href="{{route('users.index', $tool->user)}}">
                                        <span class="text-gray-600"> by: {{ $tool->user->name }}</span>
                                    </a>
                                </div>
                            </div> 
                        </div>
                        
                        
                        <img src="{{ asset('images/' . $tool->image->url) }}" alt="" class=""/>
                        <p class="mt-4 text-lg text-gray-900 m-6">{{ $tool->description}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   
</x-app-layout>