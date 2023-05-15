@props(['class' => ''])
<div class="flex flex-cols justify-center items-center flex-col">
    <div style="height:250px;background-color:#102E3A;width:100%"></div>
    <div class="{{$class}} w-10/12 md:w-9/12 lg:w-8/12 xl:w-7/12 min-h-[20%] flex flex-col justify-center items-center">
        <div class="w-full bg-white rounded-lg -mt-36 shadow-lg shadow-purple-300 md:shadow-2xl md:shadow-purple-300 ">
            {{$slot}}
        </div>
    </div>
    <div class="w-11/12 text-center text-black relative mt-10 md:absolute md:mt-0 bottom-0 mb-7 text-xs md:text-base">
        ©2021 BrainTreesPro Pty Ltd. Concept & Design by Kaveesha Perera
    </div>
</div>
