@props(['data', 'url' => null])

@if ($url)
<a :href="url">
  @if ($data['type'] === 'svg')
  <div {{ $attributes->merge(['class' => 'mr-2 h-7 w-7 rounded']) }}>
    {!! $data['content'] !!}
  </div>
  @else
  <img {{ $attributes->merge(['class' => 'mr-2 h-7 w-7 rounded']) }} src="{{ $data['content'] }}" alt="avatar" />
  @endif
</a>
@else
<div>
  @if ($data['type'] === 'svg')
  <div {{ $attributes->merge(['class' => 'mr-2 h-7 w-7 rounded']) }}>
    {!! $data['content'] !!}
  </div>
  @else
  <img {{ $attributes->merge(['class' => 'mr-2 h-7 w-7 rounded']) }} src="{{ $data['content'] }}" alt="avatar" />
  @endif
</div>
@endif
