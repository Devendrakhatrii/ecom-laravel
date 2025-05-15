@props(['name'])
@error($name)
<p class="text-xs font-light text-red-500">{{ $message }}</p>
@enderror