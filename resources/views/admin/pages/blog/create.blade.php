@extends('admin.layout.app')
@push('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-toolbar {
        background: #f5f5f5 !important;
    }
</style>
@endpush
@section('content')
<a href="{{route('admin.blog.index')}}" class="btn btn-white"> &lt; Back</a>
<div class="bg-white p-20 col-12 m-t-30">
    <form action="{{route('admin.blog.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="m-b-15">Add Blog</legend>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title"
                    placeholder="Bachelor Home Shift: 6 things you should know before shifting">
                @error('title')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug <span class="text-danger">( Unique )</span></label>
                <input type="text" class="form-control" name="slug" id="slug"
                    placeholder="bachelor-home-shift-6-things-you-should-know-before-shifting">
                @error('slug')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" id="image" accept="images/*">
                @error('image')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="blog_category_id">Blog Category</label>
                <select name="blog_category_id[]" id="blog_category_id" class="form-control" multiple>
                    @foreach ($blogCategories as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                @error('blog_category_id')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="summernote" name="description"></textarea>
                @error('description')
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
    $('#summernote').summernote({
    height: 300,
    });
    });
</script>
@endpush