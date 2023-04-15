<x-layout>
    @foreach ($posts as $post)
        <article>

            <h1><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h1>

            <div>
                <h2>{{ $post->excerpt }}</h2>
            </div>

        </article>
    @endforeach
</x-layout>
