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
                            {{__('Email')}}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{__('Group')}}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <a href="{{route('users.create')}}" class="text-indigo-600 hover:text-indigo-900">{{__('Create')}}</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @if(!$users->count())
                        <tr>
                            <td colspan="5" class="text-center">{{__('Not found')}}</td>
                        </tr>
                    @else
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{$user->id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$user->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$user->email}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$user->userGroup->group->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if (auth()->user()->canAccess('Users', \App\Classes\Permissions::EDIT))
                                        <a href="{{route('users.edit', ['id' => $user->id])}}" class="text-indigo-600 hover:text-indigo-900">{{__('Edit')}}</a>
                                    @endif
                                    @if(auth()->user()->canAccess('Users', \App\Classes\Permissions::DELETE))
                                        <button class="text-indigo-600 hover:text-indigo-900" wire:click="$emit('triggerDelete',{{ $user->id }})">{{__('Delete')}}</button>
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
        {{ $users->links() }}
    </div>


    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                @this.on('triggerDelete', id => {
                    Swal.fire({
                        title: '{{__('Вы действительно хотите удалить?')}}',
                        text: '{{__('Пользователь будет удален!')}}',
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

