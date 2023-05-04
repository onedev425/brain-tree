<button @class(["$class bg-red-600 uppercase hover:bg-opacity-90 active:bg-opacity-70 text-white py-2 px-4 border-2 dark:border-0 rounded-lg my-3"] ) {{$attributes}}>
    <i class="{{$icon}}" aria-hidden="true"></i>
    {{$slot}} {{$label}}
</button>