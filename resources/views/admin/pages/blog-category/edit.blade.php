@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.blog-category.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.blog-category.update', $blogCategory->id)}}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset>
            <legend class="m-b-15">Edit Blog Category</legend>
            @foreach ($languages as $item)
            <div class="form-group">
                <label for="name">Name ({{$item->code}})</label>
                <input type="text" class="form-control" name="name[{{$item->code}}]" id="name"
                    placeholder="Home Shifting" value="{{$blogCategory->getTranslation('name', $item->code)}}"
                    oninput="slugF()">
                @error('name')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            @endforeach
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" name="slug" id="slug" placeholder="home-shifting"
                    value="{{$blogCategory->slug}}">
                @error('slug')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary m-r-5">Update</button>
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