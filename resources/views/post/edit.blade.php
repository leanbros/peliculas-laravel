@role('administrador')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar película') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Editar</h1>
                    <br>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-white-700 mb-2">Titulo</label>
                            <input type="text" class="form-input w-full border-gray-300 rounded-md text-black"
                                id="title" name="title" value="{{ $post->title }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-white-700 mb-2">Slug</label>
                            <input type="text" class="form-input w-full border-gray-300 rounded-md text-black" id="slug"
                                name="slug" value="{{ $post->slug }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-white-700 mb-2">Contenido</label>
                            <textarea class="form-input w-full border-gray-300 rounded-md text-black" id="content"
                                name="content" required>{{ $post->content }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-white-700 mb-2">Selecciona
                                una categoría:</label>
                            <select name="category_id" id="category_id"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">>
                                @foreach($categories as $id => $titulo)
                                <option value="{{ $id }}" {{ $post->category_id == $id ? 'selected' : '' }}>
                                    {{ $id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-white-700 mb-2">Descripción</label>
                            <textarea id="description" class="form-input w-full border-gray-300 rounded-md text-black"
                                name="description" required>{{ $post->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-white-700 mb-2">Portada</label>
                            @if ($post->image)
                            <div class="mb-4">
                                <img src="{{ asset('images/' . $post->image) }}" alt="Current Image"
                                    class="w-20 h-20 object-cover rounded-md">
                            </div>
                            @endif
                            <input type="file" class="form-input w-full border-gray-300 rounded-md text-black"
                                name="image" id="image">
                        </div>

                        <div class="mb-4">
                            <label for="fondo" class="block text-sm font-medium text-white-700 mb-2">Imagen de
                                Fondo</label>
                            @if ($post->fondo)
                            <div class="mb-4">
                                <img src="{{ asset('images/' . $post->fondo) }}" alt="Current Background Image"
                                    class="w-20 h-20 object-cover rounded-md">
                            </div>
                            @endif
                            <input type="file" class="form-input w-full border-gray-300 rounded-md text-black"
                                name="fondo" id="fondo">
                        </div>


                        <div class="mb-4">
                            <label for="posted" class="block text-sm font-medium text-white-700 mb-2">Postear</label>
                            <select name="posted" id="posted"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 text-black">>
                                <option value="not" {{ $post->posted == 'not' ? 'selected' : '' }}>Not</option>
                                <option value="yes" {{ $post->posted == 'yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <br />
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@endrole