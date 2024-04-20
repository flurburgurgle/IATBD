<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Tools you've loaned:") }}
                </div>
                @foreach ($tools as $tool)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $tool->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $tool->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($tool->created_at->eq($tool->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            
                            
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->name }}</p>
                        <img src="{{ asset('images/' . $tool->image->url) }}" alt=""/>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->description}}</p>
                    </div>
                </div>
            @endforeach
            </div>
           
        </div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Tools you've loaned out:") }}
                </div>
                @foreach ($myTools as $tool)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $tool->user->name }}</span>
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
                                    <form method="POST" action="{{ route('tools.review', $tool) }}">
                                        @csrf
                                        @method('GET')
                                        <x-dropdown-link :href="route('tools.review', $tool)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Confirm tool return') }}
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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Reviews you've written:") }}
                </div>
                @foreach ($myReviews as $review)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $review->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $review->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                            
                            
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $review->content}}</p>
                    </div>
                </div>
            @endforeach
            </div>
           
        </div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Reviews about you:") }}
                </div>
                @foreach ($reviewsAM as $review)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{route('users.index', $review->user)}}">
                                    <span class="text-gray-800">{{ $review->user->name }}</span>
                                </a>
                                
                                <small class="ml-2 text-sm text-gray-600">{{ $review->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                            
                            
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $review->content}}</p>
                    </div>
                </div>
            @endforeach
            </div>
           
        </div>
    </div>
</x-app-layout>
