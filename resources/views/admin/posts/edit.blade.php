<x-layout>
    <x-setting :heading="'Edit A Post: ' . $posts->title">
        <form action="/admin/posts/{{ $posts->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.form-input name="title" :value="old('title', $posts->title)"/>
            <x-form.form-input name="slug" :value="old('$this->slug', $posts->slug)"/>
            <x-form.textarea name="excerpt">{{ old('body', $posts->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $posts->body) }}</x-form.textarea>
            <div class="flex mt-6 ">
                <div class="flex-1">
                    <x-form.form-input name="thumbnail" type="file" :value="old('thumbnail', $posts->thumbnail)"/>
                </div>

                <img src="{{ asset('storage/' . $posts->thumbnail) }}" alt="" width="100" class="rounded-xl ml-6">
            </div>

            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" required>
                    @foreach( \App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $posts->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>


            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
