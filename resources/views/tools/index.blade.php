<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tools') }}
        </h2>
    </x-slot>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8 lg:max-w-5xl">
        <form class="max-w-xl container mx-auto" method="POST" enctype="multipart/form-data" action="{{ route('tools.store') }}">
            @csrf
            <textarea
                name="name"
                placeholder="{{ __('Name your item') }}"
                class="resize-none h-11 my-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name') }}</textarea>
            <textarea
                name="description"
                placeholder="{{ __('Describe your item') }}"
                class="resize-none h-20 my-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            <p class="font-bold">Upload an Image</p>
            <input 
                type="file"
                accept="image/png, image/jpeg, image/jpg"
                name="url"
                class="block w-full mb-4"
            >{{ old('image_url') }}</input>
            <p class="font-bold">Select a Category</p>
            <select name="category" class="mb-4 rounded-lg">
                <option value="" disabled selected>Select a Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
            <br>
            <x-primary-button class="mt-4">{{ __('Share') }}</x-primary-button>
        </form>
        <div class="grid grid-cols-1 max-w-1xl mt-6 lg:grid-cols-3 lg:max-w-4/5">
            @foreach ($tools as $tool)
                <div class="p-6 bg-white rounded-lg m-1 shadow-sm flex space-x-2 hover:shadow-xl">
                    <img src="{{URL::asset('/images/tag.png')}}" alt="" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div class="w-full">
                                <span class="text-gray-800">{{ $tool->user->name }}</span>
                                @if ($tool->user->is(auth()->user()))
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('tools.edit', $tool)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link :href="route('images.edit', $tool)">
                                                {{ __('Edit image') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                @endif
                                <br>
                                <small class="text-sm text-gray-600">{{ $tool->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($tool->created_at->eq($tool->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->name }}</p>
                        <img class="" src="{{ asset('images/' . $tool->image->url) }}" alt=""/>
                        <p class="mt-4 text-lg text-gray-900">{{ $tool->description}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   
</x-app-layout>