<div @class(["flex flex-col my-2"])>
    <label for="{{$id}}" @class(["font-bold my-3"])>{{$label}}</label>
    <input id={{$id}} name="{{$name}}" @class(["border border-gray-500 p-2 rounded-md bg-inherit dark:bg-transparent w-full", 'border-red-500 ' => $errors->$errorBag->has($name)]) {{$attributes}} value="{{old($name) ?? ($value != null ? $value : '')}}">
    @error($name, $errorBag)
        <p class="text-red-700 dark:text-red-500 my-2">{{$message}}</p>
    @enderror
</div>