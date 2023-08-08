@props(['buttonLabel' => 'Actions', 'links', 'buttonClass' => null, 'dropdownClass' => null])

<div class="relative flex-col inline-block max-w-max justify-between" x-data="{dropdown : false}" >
    <x-button label="{{$buttonLabel}}" icon="fas fa-angle-down mx-2" class="{{$buttonClass}} bg-gray-500 capitalize border"  aria-haspopup="true" type="button" aria-expanded="false" @click="dropdown = !dropdown"/>
    <div @click.outside="dropdown = false" class="{{$dropdownClass}} absolute top-14 p-2 min-w-[36] z-30 bg-white border dark:bg-gray-800 rounded" x-show="dropdown" style="display: none">
        {{$slot}}
    </div>
</div>