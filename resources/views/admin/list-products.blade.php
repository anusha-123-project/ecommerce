@extends('admin.master')
@section('content')
 <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <!-- <a href="{{ route('admin.create.category') }}" class="btn btn-primary float-end">Add Category</a> -->
              <button type="button" onclick="window.location.href='{{ route('admin.create.products') }}'" class="btn btn-primary float-end">Add Products</button>


             <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      No
                    </th>
                    <th>Name</th>
                    <th>category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>stock</th>
                    <th>status</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$product->title}}</td>
                   
                    <td> {{ $product->parent ? $product->parent->title : 'None' }}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->stock}}</td>
                    <td>{{$product->status}}</td>
                    <td>
    @foreach ($product->images as $image)
        <img src="{{ asset('storage/product_images/' . $image->image) }}" alt="Product Image" style="width: 100px; margin-right: 5px;">
    @endforeach
</td>


                    <td>
                  
                   <a href="{{ url('edit-products/' . $product->id) }}"> Edit </a>
                    <a href="{{ url('delete-products/'.$product->id)}}" onclick="return confirm('are you sure want to delete?')" >Delete</a>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    @endsection