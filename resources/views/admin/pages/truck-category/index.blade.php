@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-category.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-striped m-b-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Covered</th>
                    <th>Description</th>
                    <th width="1%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($truckCategories as $index => $truckCategory)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$truckCategory->truckModelCategory->truckBrandCategory->name}}
                        {{$truckCategory->truckModelCategory->model}}</td>
                    <td>{{$truckCategory->truckSizeCategory->size}}</td>
                    <td> {{$truckCategory->truckWeightCategory->weight}}</td>
                    <td> {{$truckCategory->truckCoveredCategory->name}}</td>
                    <td>{{$truckCategory->description}}</td>
                    <td class="with-btn" nowrap="">
                        <a href="{{route('admin.truck-category.edit', $truckCategory->id)}}"
                            class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger width-60"
                            onclick="event.preventDefault(); document.getElementById('language{{ $index }}').submit();">
                            Delete
                        </a>
                        <form id="language{{ $index }}"
                            action="{{ route('admin.truck-category.destroy', $truckCategory->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection