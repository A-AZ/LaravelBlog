@auth()
    <x-panel>
        <form action="/posts/{{ $post->slug }}/comments" method="post">
            @csrf

            <header class="flex items-center">
                <img src="https://i.pravatar.cc/60?u={{ auth()->id() }}" alt="" width="80"
                     height="80"
                     class="rounded-full">
                <h2 class="ml-5">
                    Want to share your opinion ?
                </h2>
            </header>

            <div
                class="mt-6">
                <label for="body">
                    <textarea name="body" id="body" rows="6" class="w-full text-sm focus:outline-none focus:ring"
                              placeholder="Write a comment..." required></textarea>
                </label>
                @error('body')
                <span class="text-xs text-red-500">
                                            {{ $message }}
                                        </span>
                @enderror
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                <x-submit-button>
                    Post
                </x-submit-button>
            </div>

        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> Or
        <a href="/login" class="hover:underline">
            Login to leave a commnet
        </a>
    </p>
@endauth
