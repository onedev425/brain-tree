<div @class(["$groupClass flex flex-col my-2"])>
    <label for="{{$id}}" @class(["$labelClass font-bold my-3"])>{{$label}} {!! $required ? "<span class='text-red-500'>*</span>" : "" !!}</label>
    <input id={{$id}} name="{{$name}}" @class(["$class border border-gray-500 p-2 rounded bg-inherit w-full", 'border-red-500 ' => $errors->$errorBag->has($name)]) {{$attributes}} value="{{old($name) ?? ($value != null ? $value : '')}}">
    @error($name, $errorBag)
        <p class="text-red-700 my-2">{{$message}}</p>
    @enderror
</div>
