@extends('layouts.adminapp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Categories</h4>

                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d-M-Y') }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $category->id }}">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="edit{{ $category->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="edit{{ $category->id }}Label">Edit
                                                        Category {{ $category->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter Name"
                                                            value="{{ $category->name }}" name="name">
                                                        @if ($errors->has('name'))
                                                        <strong
                                                            class="text-danger">{{ $errors->first('name') }}</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info btn-sm">update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#remove{{ $category->id }}">
                                    Remove
                                </button>

                                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div class="modal fade" id="remove{{ $category->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="remove{{ $category->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="remove{{ $category->id }}Label">
                                                        {{ $category->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to remove this iteam ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
<div class="col-md-4 col-md-4" style="margin-top:10px">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title">Create New  category</h4>
        </div>
        <form role="form" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name"
                        name="name">
                    @if($errors->has('name'))
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                    @endif
             </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </form>
    </div>
 </div>
</div>
</div>
@endsection
