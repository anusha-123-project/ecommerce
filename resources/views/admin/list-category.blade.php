@extends('admin.master')
@section('content')
 <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
          
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>
              <!-- <a href="{{ route('admin.create.category') }}" class="btn btn-primary float-end">Add Category</a> -->
              <button type="button" onclick="window.location.href='{{ route('admin.create.category') }}'" class="btn btn-primary float-end">Add Category</button>


             <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      No
                    </th>
                    <th>Name</th>
                    <th>parent category</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $cat)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$cat->title}}</td>
                   
                    <td> {{ $cat->parent ? $cat->parent->title : 'None' }}</td>
                    <td><img src="{{ asset('storage/images/'.$cat->image) }}" alt="Product Image" style="width: 100px; margin-right: 5px;"></td>
                    <td>
                  
                   <a href="{{ url('edit-category/' . $cat->id) }}"> Edit </a>
                    <a href="{{ url('delete-category/'.$cat->id)}}" onclick="return confirm('are you sure want to delete?')" >Delete</a>
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