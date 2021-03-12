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
    <form action="{{route('admin.blog.update', $blog->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <fieldset>
            <legend class="m-b-15">Edit Blog</legend>
            @foreach ($languages as $item)
            <div class="form-group">
                <label for="title">Title ({{$item->code}})</label>
                <input type="text" class="form-control" name="title[{{$item->code}}]" id="title"
                    placeholder="Bachelor Home Shift: 6 things you should know before shifting"
                    value="{{$blog->getTranslation('title', $item->code)}}">
                @error('title[{{$item->code}}]')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            @endforeach
            <div class="form-group">
                <label for="slug">Slug <span class="text-danger">( Unique )</span></label>
                <input type="text" class="form-control" name="slug" id="slug"
                    placeholder="bachelor-home-shift-6-things-you-should-know-before-shifting" value="{{$blog->slug}}">
                @error('slug')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <img id="user-image" style="width: 488px; height: 319px;"
                    src="{{asset( $blog->image ?: 'images/825x340.png')}}" alt="your image" /><br>
                <input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);"
                    accept="images/*" />
                <input type="button" class="btn btn-outline-secondary" style="width: 488px;" value="Update Image"
                    onclick="document.getElementById('user-image-btn').click();" />
                @error('image')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="blog_category_id">Blog Category</label>
                @php
                $blogCategoryIds = $blog->blogCategories->pluck("id")->all();
                @endphp
                <select name="blog_category_id[]" id="blog_category_id" class="form-control" multiple>
                    @foreach ($blogCategories as $item)
                    <option value="{{$item->id}}" {{selected($item->id, $blogCategoryIds)}}>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('blog_category_id')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            @foreach ($languages as $item)
            <div class="form-group">
                <label for="summery">Summery ({{$item->code}})</label>
                <textarea name="summery[{{$item->code}}]" id="summery" cols="30" rows="5"
                    class="form-control">{{$blog->getTranslation('summery', $item->code)}}</textarea>
            </div>
            @endforeach
            @foreach ($languages as $item)
            <div class="form-group">
                <label for="description">Description ({{$item->code}})</label>
                <textarea id="summernote-{{$item->code}}"
                    name="description[{{$item->code}}]">{!!$blog->getTranslation('description', $item->code)!!}</textarea>
                @error('description[{{$item->code}}]')
                <span class="text-red">{{$message}}</span>
                @enderror
            </div>
            @endforeach
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
        @foreach ($languages as $item)
        $('#summernote-{{$item->code}}').summernote({
            height: 300,
        });
        @endforeach
    });
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#user-image')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush