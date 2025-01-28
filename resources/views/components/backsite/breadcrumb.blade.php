<ul class="inline-flex flex-wrap text-sm font-medium">
    @foreach (generateBreadcrumbs() as $breadcrumb)
        <li class="flex items-center">
            @if ($breadcrumb['url'])
                <a class="text-gray-500 dark:text-gray-400 hover:text-violet-500 dark:hover:text-violet-500"
                    href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                <svg class="fill-current text-gray-400 dark:text-gray-600 mx-3" width="16" height="16"
                    viewBox="0 0 16 16">
                    <path d="M6.6 13.4L5.2 12l4-4-4-4 1.4-1.4L12 8z" />
                </svg>
            @else
                <span class="text-gray-500 dark:text-gray-400">{{ $breadcrumb['name'] }}</span>
            @endif
        </li>
    @endforeach
</ul>