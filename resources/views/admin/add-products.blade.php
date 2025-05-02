@extends('admin.master')
@section('content')

<section class="section">
    <div class="row">
        <!-- Smaller Back Button (Corrected) -->
        <button type="button" onclick="window.location.href='{{ route('admin.view.products') }}'" 
            class="btn btn-primary float-end" >Back</button>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vertical Form</h5>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>

                        <script>
                            setTimeout(function() {
                                document.getElementById('success-message').style.display = 'none';
                            }, 2000); // 2000ms = 2 seconds
                        </script>
                    @endif

                    <!-- Vertical Form -->
                    <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('admin.save.products') }}">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


                        <div class="col-12">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" name="category_id" id="category">
                                <option value="">--Select Category--</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="title" class="form-label">price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="title" class="form-label">stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- <div class="col-12">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div> -->
                        <div class="col-12">
    <label for="image" class="form-label">Image (<span id="image-count">0</span> files selected)</label>
    <input type="file" class="form-control" id="image" name="image[]" multiple accept="image/*">
</div>
<div id="image-preview" class="mt-3 d-flex flex-wrap"></div>
<script>
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('image-preview');
    const imageCountLabel = document.getElementById('image-count');
    let selectedFiles = [];

    imageInput.addEventListener('change', (event) => {
        const files = Array.from(event.target.files);

        files.forEach((file) => {
            selectedFiles.push(file);
            displayImage(file);
        });

        updateFileInput();
        updateImageCount();
    });

    function displayImage(file) {
        const previewDiv = document.createElement('div');
        previewDiv.style.position = 'relative';
        previewDiv.style.display = 'inline-block';
        previewDiv.style.marginRight = '10px';
        previewDiv.style.marginBottom = '10px';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.alt = file.name;
        img.style.width = '100px';
        img.style.height = '100px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '8px';
        img.style.display = 'block';

        const closeButton = document.createElement('button');
        closeButton.innerHTML = '×';
        closeButton.style.position = 'absolute';
        closeButton.style.top = '-5px';
        closeButton.style.right = '-5px';
        closeButton.style.background = 'red';
        closeButton.style.color = 'white';
        closeButton.style.border = 'none';
        closeButton.style.borderRadius = '50%';
        closeButton.style.width = '20px';
        closeButton.style.height = '20px';
        closeButton.style.cursor = 'pointer';
        closeButton.style.fontSize = '14px';
        closeButton.style.lineHeight = '16px';
        closeButton.style.textAlign = 'center';

        closeButton.addEventListener('click', () => {
            selectedFiles = selectedFiles.filter(f => f !== file);
            previewDiv.remove();
            updateFileInput();
            updateImageCount();
        });

        previewDiv.appendChild(img);
        previewDiv.appendChild(closeButton);
        previewContainer.appendChild(previewDiv);

        // Free up memory after the image loads
        img.onload = () => URL.revokeObjectURL(img.src);
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }

    function updateImageCount() {
        imageCountLabel.textContent = selectedFiles.length;
    }
</script>
                       <div class="col-12">
                            <label for="title" class="form-label">Status</label>
                            <!-- <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}"> -->
                             <select class="form-control" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


