<div>
    @error('name') <div class="text-red-900 p-3">{{ $message }}</div> @enderror

    <div class="my-2">
        <label for="name" class="block text-sm font-medium text-gray-700">{{__('Name')}}</label>
        <input type="text" name="name" id="name" wire:model="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
    </div>
    @foreach(config('module.modules') as $module)
        <h1 class="my-2">{{$module}}</h1>
        <div class="flex flex-row">
            <div class="flex items-start mr-3">
                <div class="flex items-center h-5">
                    <input id="{{$module}}.{{\App\Classes\Permissions::VIEW}}" wire:model="permissions.{{$module}}.{{\App\Classes\Permissions::VIEW}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="{{$module}}.{{\App\Classes\Permissions::VIEW}}" class="font-medium text-gray-700">{{__('View')}}</label>
                </div>
            </div>
            <div class="flex items-start mr-3">
                <div class="flex items-center h-5">
                    <input id="{{$module}}.{{\App\Classes\Permissions::EDIT}}" wire:model="permissions.{{$module}}.{{\App\Classes\Permissions::EDIT}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="{{$module}}.{{\App\Classes\Permissions::EDIT}}" class="font-medium text-gray-700">{{__('Edit')}}</label>
                </div>
            </div>
            <div class="flex items-start mr-3">
                <div class="flex items-center h-5">
                    <input id="{{$module}}.{{\App\Classes\Permissions::CREATE}}" wire:model="permissions.{{$module}}.{{\App\Classes\Permissions::CREATE}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="{{$module}}.{{\App\Classes\Permissions::CREATE}}" class="font-medium text-gray-700">{{__('Create')}}</label>
                </div>
            </div>
            <div class="flex items-start mr-3">
                <div class="flex items-center h-5">
                    <input id="{{$module}}.{{\App\Classes\Permissions::DELETE}}" wire:model="permissions.{{$module}}.{{\App\Classes\Permissions::DELETE}}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                </div>
                <div class="ml-3 text-sm">
                    <label for="{{$module}}.{{\App\Classes\Permissions::DELETE}}" class="font-medium text-gray-700">{{__('Delete')}}</label>
                </div>
            </div>
        </div>
    @endforeach

    <div class="px-4 py-3 text-right sm:px-6">
        <button type="button" wire:click="save" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{__('Save')}}
        </button>
    </div>
</div>
