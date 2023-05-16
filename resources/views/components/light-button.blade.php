<button type="button" @class(["$class uppercase inline-block py-2 px-4 border-2 rounded-lg my-3 hover:bg-gray-50"] ) {{$attributes}}>
    <i class="{{$icon}}" aria-hidden="true"></i>
    {{$slot}} {{$label}}
</button>
