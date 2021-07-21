<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('ID')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Name')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Permission')}}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <a href="{{route('groups.create')}}" class="text-indigo-600 hover:text-indigo-900">{{__('Create')}}</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @if(!$groups->count())
                        <tr>
                            <td colspan="4" class="text-center">{{__('Not found')}}</td>
                        </tr>
                    @else
                        @foreach($groups as $group)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{$group->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$group->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @foreach(config('module.modules') as $module)
                                        <div class="p-2">{{$module}}</div>
                                        <div class="flex flex-row">
                                            @foreach($group->permissions->where('module', $module) as $permission)
                                                @if($permission->value)
                                                    <div class="p-1">{{$permission->permission}}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if (auth()->user()->canAccess('Groups', \App\Classes\Permissions::EDIT))
                                        <a href="{{route('groups.edit', ['id' => $group->id])}}" class="text-indigo-600 hover:text-indigo-900">{{__('Edit')}}</a>
                                    @endif
                                    @if(auth()->user()->canAccess('Groups', \App\Classes\Permissions::DELETE))
                                        <button class="text-indigo-600 hover:text-indigo-900" wire:click="$emit('triggerDelete',{{ $group->id }})">{{__('Delete')}}</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="py-5">
        {{ $groups->links() }}
    </div>


    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                @this.on('triggerDelete', id => {
                    Swal.fire({
                        title: '{{__('Вы действительно хотите удалить?')}}',
                        text: '{{__('Группа будет удалена!')}}',
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: '{{__('Удалить')}}',
                        cancelButtonText: '{{__('Отмена')}}'
                    }).then((result) => {
                        //if user clicks on delete
                        if (result.value) {
                            // calling destroy method to delete
                            @this.call('destroy', id);
                        }
                    });
                });
            })
        </script>
    @endpush
</div>

