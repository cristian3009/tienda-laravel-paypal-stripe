<div>
    <h2 class="text-center">Add new product</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <form wire:submit.prevent="save">
                    <label>Name</label>
                    <input type="text" wire:model="name" class="form-control mb-2">
                    @error('name') <p class="text-danger mb-2">{{ $message }}</p>@enderror

                    <label>Description</label>
                    <textarea cols="20" rows="5" wire:model="description" class="form-control mb-2"></textarea>
                    @error('description') <p class="text-danger mb-2">{{ $message }}</p>@enderror

                    <label>Price</label>
                    <input type="number" wire:model="price" class="form-control mb-2">
                    @error('price') <p class="text-danger mb-2">{{ $message }}</p>@enderror

                    <label>Thumbnail</label>
                    <input type="file" wire:model="thumbnail" class="form-control mb-2">
                    @if($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="img-fluid mb-2" alt="">
                    @endif
                    @error('thumbnail') <p class="text-danger mb-2">{{ $message }}</p>@enderror

                    <button type="submit" class="btn btn-outline-primary w-100">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>
