@props(['class' => ''])
<div class="flex flex-cols justify-center items-center my-12 flex-col">
    <div class="{{$class}} w-10/12 md:w-8/12 lg:w-7/12 xl:w-6/12 min-h-[20%] flex flex-col justify-center items-center bg-purple-500 rounded-lg p-3">
       {{$slot}}
    </div>
</div>
