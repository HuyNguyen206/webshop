@props(['title' => false])
<div {{$attributes->class(['bg-white p-4'])}}>
    @if($title)
        <h2 class="font-medium text-xl"> {{$title}}</h2>
    @endif

    <div>
        {{$slot}}
    </div>
</div>
