<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ingredients page') }}
        </h2>
    </x-slot>
    <div class="max-w-5xl m-auto mt-2 p-2">
        <div class="flex flex-col gap-2">
            @foreach (\App\Models\Ingredient::all() as $ingredient)
                <div class="bg-gray-300 grid grid-cols-8 text-center p-2 relative" x-data="{ showDelete: false, editMode: false }">
                    <template x-if="showDelete">
                        <div class="absolute top-0 bottom-0 left-0 right-0 bg-red-600 flex items-center justify-center">
                            <form 
                                action="{{ route('ingredients.destroy', $ingredient) }}" 
                                method="POST" 
                            >
                                @csrf
                                @method('DELETE')
                                <x-danger-button>Delete</x-danger-button>
                            </form>
                            <x-primary-button @click="showDelete = false">Cancelar</x-primary-button>
                        </div>
                    </template>
                    <div class="col-span-6 text-left">
                        <template x-if="!editMode">
                            <span>
                                {{ $ingredient->name }}
                            </span>
                        </template>
                        <template x-if="editMode">
                            <form 
                                action="{{ route('ingredients.update', $ingredient) }}" 
                                method="POST" 
                            >
                                @csrf
                                @method('PUT')
                                <x-text-input type="text" name="name" value="{{ $ingredient->name }}" /> 
                                <x-primary-button>Salvar</x-primary-button>
                            </form>
                        </template>
                    </div>
                    <template x-if="!editMode">
                        <div class="cursor-pointer hover:bg-gray-700 hover:text-white" @click="editMode = true">
                            Edit
                        </div>
                    </template>
                    <template x-if="editMode">
                        <div class="cursor-pointer hover:bg-gray-700 hover:text-white" @click="editMode = false">
                            Cancel
                        </div>
                    </template>
                    <div class="cursor-pointer hover:bg-red-700 hover:text-white" @click="showDelete = true">
                        Delete
                    </div>
                </div>
            @endforeach
        </div>
        <form action="{{ route('ingredients.store') }}" method="POST">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Ingredient name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>
            <div>
                <x-primary-button>Save</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>