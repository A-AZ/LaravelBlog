<x-layout>
    <x-setting heading="Publish A New Post">
        <form action="/admin/posts" method="post" enctype="multipart/form-data">
            @csrf

            <x-form.form-input name="title"/>
            <x-form.textarea name="excerpt"/>
            <x-form.textarea name="body"/>
            <x-form.form-input name="thumbnail" type="file"/>


            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" required>
                    @foreach( \App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>


            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
