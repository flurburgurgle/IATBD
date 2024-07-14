<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8 lg:max-w-5xl">
        <div class="max-w-4/5 mx-auto my-2 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 max-w-1xl mt-6 lg:grid-cols-3 lg:max-w-4/5">
                <div class="p-6 bg-white font-bold text-gray-900 overflow-hidden shadow-sm sm:rounded-lg lg:col-span-3">
                    {{ __("Tools you've loaned:") }}
                </div>
                @foreach ($tools as $tool)
                <div class="p-0 bg-white shadow-sm m-1 rounded-lg hover:shadow-xl">
                    
                    <div class="flex-1">
                        <div class="bg-blue-100 pt-0.5 rounded-t-lg">
                           <div class="flex justify-between items-center m-2">
                                <div class="w-full">
                                    <img src="{{URL::asset('/images/tag.png')}}" alt="" class="h-6 w-6 text-gray-600 -scale-x-100 float-left mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <span class="mt-4 text-xl font-semibold text-gray-900">{{ $tool->name }}</span>
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
        <div class="max-w-4/5 mx-auto my-2 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 max-w-1xl mt-6 lg:grid-cols-3 lg:max-w-4/5">
                <div class="p-6 bg-white font-bold text-gray-900 overflow-hidden shadow-sm sm:rounded-lg lg:col-span-3">
                    {{ __("Tools you've loaned out:") }}
                </div>
                @foreach ($myTools as $tool)
                <div class="p-0 bg-white shadow-sm m-1 rounded-lg hover:shadow-xl">
                    
                    <div class="flex-1">
                        <div class="bg-blue-100 pt-0.5 rounded-t-lg">
                           <div class="flex justify-between items-center m-2">
                                <div class="w-full">
                                    <img src="{{URL::asset('/images/tag.png')}}" alt="" class="h-6 w-6 text-gray-600 -scale-x-100 float-left mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <span class="mt-4 text-xl font-semibold text-gray-900">{{ $tool->name }}</span>
                                    <a class="float-right" href="{{route('tools.review', $tool)}}">
                                        <img src="{{URL::asset('/images/return.png')}}" class="h-6 w-6 hover:animate-pulse active:animate-ping-once" alt="return BTN" />
                                    </a>
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
        <div class="max-w-xl grid grid-cols-1 lg:grid-cols-2 lg:max-w-5xl">
            <div class="max-w-2xl w-2xl my-2 sm:px-6 lg:px-8">
                <div class="bg-white max-h-100 shadow-sm sm:rounded-lg">
                    <div class="p-6 font-bold bg-blue-100 text-gray-900 h-20">
                        {{ __("Reviews you've written:") }}
                    </div>
                    <div class="overflow-auto max-h-80">
                        @foreach ($myReviews as $review)
                            <div class="p-6 odd:bg-blue-50 even:bg-slate-50 flex space-x-2">
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
            
            </div>
            <div class="max-w-2xl w-2xl my-2 sm:px-6 lg:px-8">
                <div class="bg-white max-h-100 shadow-sm sm:rounded-lg">
                    <div class="p-6 font-bold bg-blue-100 text-gray-900 h-20">
                        {{ __("Reviews about you:") }}
                    </div>
                    <div class="overflow-auto max-h-80">
                        @foreach ($reviewsAM as $review)
                            <div class="p-6 odd:bg-blue-50 even:bg-slate-50 flex space-x-2">
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
            
            </div> 
        </div>
    </div>
</x-app-layout>
