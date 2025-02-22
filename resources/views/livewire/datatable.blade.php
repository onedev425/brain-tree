<div>
    <x-loading-spinner/>
    <div class="flex items-center justify-end">
        <input id="datatable-search-{{$uniqueId}}" type="search" wire:model.sebounce.500ms="search"  placeholder="Search" class="border border-gray-300 rounded-l py-2 px-4"/>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-r py-2 px-4 focus:outline-none focus:ring focus:border-red-300">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="text-center my-4 border rounded-lg">
        <table class="w-full table-auto">
            <thead class="">
                @foreach ($columns as $column)
                    @if (!isset($column['can']) || auth()->user()->can($column['can']))
                        <th class="capitalize p-4 whitespace-nowrap">{{str_replace('_' , ' ', Str::snake( $column['name'] ??  $column['property']))}}</th>
                    @endif
                @endforeach
            </thead>
            <tbody class="">
                @if ($collection->isNotEmpty())
                    @foreach ($collection as $item)
                        <tr class="border-t">
                            @foreach ($columns as $column)
                                @if (!isset($column['can']) || auth()->user()->can($column['can']))
                                    <td class="p-4 whitespace-nowrap">
                                        @php
                                            $model = $item;
                                            if (isset($column['relation'])) {
                                                $relations = explode('.',$column['relation']);
                                                foreach ($relations as $relation){
                                                    $model = $model->$relation;
                                                }
                                            }
                                            if (is_array($model)) {
                                                $model = collect($model);
                                            }

                                        @endphp
                                        <p>
                                            @if (array_key_exists('method', $column) && !empty($column['method']))
                                                {{ ($model?->{$column['method']}()) }}
                                            @elseif (array_key_exists('type', $column) && !empty($column['type']))
                                                @if ($column['type'] == 'delete')
                                                    <x-modal title="Confirm {{$column['name']}}" background-colour="bg-red-600">
                                                        <div class="text-gray-700 dark:text-white">
                                                            <i class="fa fa-trash text-7xl" aria-hidden="true"></i>
                                                            <p class="my-2">Are you sure you want to {{Str::lower($column['name'])}} this resource</p>
                                                        </div>
                                                        <x-slot:footer>
                                                            <form action="{{route($column['action'],array_merge(($column['pre-route-parameters'] ?? []),[$model->id], ($column['post-route-parameters'] ?? [])))}}" method="POST">
                                                                <x-button class="bg-red-600" icon="fa fa-trash" >
                                                                    Continue with {{Str::lower($column['name'])}}
                                                                </x-button>
                                                                @method('delete')
                                                                @csrf
                                                            </form>
                                                        </x-slot:footer>
                                                    </x-modal>
                                                @elseif ($column['type'] == 'dropdown')
                                                    <x-dropdown >
                                                        @foreach ($column['links'] as $link)
                                                            @if (!isset($link['can']) || auth()->user()->can($link['can']))
                                                                <a href="{{route($link['href'],array_merge(($link['pre-route-parameters'] ?? []),[$model->id], ($link['post-route-parameters'] ?? [])))}}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 "><i class="{{$link['icon'] ?? ''}}" aria-hidden="true"></i>{{$link['text']}}</a>
                                                            @endif
                                                        @endforeach
                                                    </x-dropdown>
                                                @elseif ($column['type'] == 'href')
                                                    <div class="flex">
                                                        @if ($column['image'] != '')
                                                            <img width="50" height="50" class="rounded-full" src="{{ asset('upload/user/' . ($model?->{$column['image']})) }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
                                                        @endif
                                                        <a href="{{route($column['links'],array_merge(($column['links']['pre-route-parameters'] ?? []),[$model->id], ($column['links']['post-route-parameters'] ?? [])))}}" class="flex capitalize items-center justify-start gap-2 py-3 px-6 hover:bg-white hover:bg-opacity-20 {{ $column['class'] ?? '' }}">{{ ($model?->{$column['property'] ?? $column['text']}) }}</a>
                                                    </div>
                                                @elseif($column['type'] == 'boolean-switch')
                                                <form action="{{route($column['action'], $model->id)}}" method="POST">
                                                    @csrf
                                                    <label class="relative inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" class="sr-only peer" name="{{$column['field']}}" onChange="this.form.submit()" @checked($model?->{$column['property'] ?? $column['name']}  == true)>
                                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                                                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$model?->{$column['property'] ?? $column['name']} == true ? ($column['true-statement'] ?? 'Yes') : ($column['false-statement'] ?? 'No') }}</span>
                                                    </label>
                                                </form>
                                                @endif
                                            @else
                                                @php
                                                    $property = ($model?->{$column['property'] ?? $column['name']})
                                                @endphp
                                                @if ($property instanceof \Carbon\Carbon)
                                                    {{$property->format('Y/m/d')}}
                                                @elseif($property instanceof \Brick\Money\Money)
                                                    {{$property->formatTo(app()->getLocale())}}
                                                @else
                                                    {{$property}}
                                                @endif
                                            @endif
                                        </p>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    <tr w-full>
                        <td class="p-4 capitalize" colspan="100%">No data to Show</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="my-3">
        {{$collection->links()}}
    </div>
</div>
