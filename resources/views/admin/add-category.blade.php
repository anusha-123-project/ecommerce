@extends('admin.master')
@section('content')

<section class="section">
    <div class="row">
        <!-- Smaller Back Button (Corrected) -->
        <button type="button" onclick="window.location.href='{{ route('admin.category.list') }}'" 
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
                    <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('admin.save.category') }}">
                        @csrf
                        <div class="col-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            @error('title')
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
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- Vertical Form -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
