<div class="grid grid-cols-6 gap-6">
    <div class="col-span-3 sm:col-span-3">
        <label for="name" class="block text-sm font-medium text-gray-700">{{__('Name')}}</label>
        <input type="text" name="name" id="name" wire:model="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-3 sm:col-span-3">
        <label for="email" class="block text-sm font-medium text-gray-700">{{__('Email')}}</label>
        <input type="email" name="email" id="email" wire:model="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-6 sm:col-span-3">
        <label for="password" class="block text-sm font-medium text-gray-700">{{__('Password')}}</label>
        <input type="password" name="password" id="password" wire:model="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>
    <div class="col-span-6 sm:col-span-3">
        <label for="passconf" class="block text-sm font-medium text-gray-700">{{__('Confirm password')}}</label>
        <input type="password" name="passconf" id="passconf" wire:model="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <div class="col-span-3 sm:col-span-3">
        <label for="group" class="block text-sm font-medium text-gray-700">{{__('Group')}}</label>
        <select id="group" name="group" wire:model="group" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option>{{__('Empty')}}</option>
            @foreach($groups as $id => $name)
                <option value="{{$id}}">{{$name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-span-6 sm:col-span-3 mt-6 text-right">
        <button type="button" wire:click="save" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{__('Save')}}
        </button>
    </div>
</div>
