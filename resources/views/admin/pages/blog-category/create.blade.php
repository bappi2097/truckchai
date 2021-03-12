@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.blog-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.blog-category.store')}}" method="POST">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Blog Category</legend>
            @foreach ($languages as $item)
            <div class="form-group">
                <label for="name">Name ({{$item->code}})</label>
                <input type="text" class="form-control" name="name[{{$item->code}}]" id="name" oninput="slugF()">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            @endforeach
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" placeholder="home-shifting">
                @error('slug')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-sm btn-default">Cancel</a>
        </fieldset>
    </form>
</div>
@endsection
@push('script')
<script>
    function slugF()
        {
            let name = document.querySelector('#name').value;
            if(name)
            {
                document.querySelector('#slug').value = name.replace(/[^a-zA-Z0-9 -]/g, "").toLowerCase().split(" ").join('-');
            }else{
                document.querySelector('#slug').value = "";
            }
        }
</script>
@endpush