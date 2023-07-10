@props([
    'title' => '',
    'description' => '',
])

<div class="group relative flex items-start" aria-current="step">
    <span class="flex h-9 items-center" aria-hidden="true">
      <span class="relative z-10 flex h-8 w-8 items-center justify-center rounded-full border-2 border-green-600 bg-white">
        <span class="h-2.5 w-2.5 rounded-full bg-green-600"></span>
      </span>
    </span>
    <span class="ml-4 flex min-w-0 flex-col">
      <span class="text-xl font-medium text-green-600">{{ $title }}</span>
      <span class="text-sm text-gray-500">{{ $description }}</span>
    </span>
</div>
