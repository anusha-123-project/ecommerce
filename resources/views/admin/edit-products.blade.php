@extends('admin.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="section">
    <div class="row">
        <!-- Back Button -->
        <button type="button" onclick="window.location.href='{{ route('admin.view.products') }}'" 
            class="btn btn-primary float-end">Back</button>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Product</h5>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('success-message').style.display = 'none';
                            }, 2000);
                        </script>
                    @endif

                    <!-- Edit Form -->
                    <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('admin.update.products', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $product->title) }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" name="category_id" id="category">
                                <option value="">--Select Category--</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->cat_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label">Images (<span id="image-count">{{ count($product->images) }}</span> selected)</label>
                            <input type="file" class="form-control" id="image" name="image[]" multiple accept="image/*">
                        </div>

                        <!-- Image Preview Section -->
                        <div id="image-preview" class="mt-3 d-flex flex-wrap">
                            @foreach($product->images as $image)
                                <div class="image-container" style="position: relative; display: inline-block; margin-right: 10px; margin-bottom: 10px;">
                                    <img src="{{ asset('storage/product_images/' . $image->image) }}" 
                                         alt="Product Image" 
                                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                                    <button type="button" class="delete-image" data-image-id="{{ $image->id }}"
                                            style="position: absolute; top: -5px; right: -5px; background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer; font-size: 14px; line-height: 16px; text-align: center;">×</button>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                    <script>
                        document.querySelectorAll('.delete-image').forEach(button => {
                            button.addEventListener('click', function () {
                                let imageId = this.getAttribute('data-image-id');
                                let container = this.parentElement;
                                
                                fetch("{{ route('admin.delete.image') }}", {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ image_id: imageId })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        container.remove();
                                    } else {
                                        alert('Error deleting image.');
                                    }
                                })
                                .catch(error => console.log(error));
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
