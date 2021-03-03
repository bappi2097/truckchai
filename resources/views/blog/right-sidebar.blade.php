<div class="pt-3 pr-5 col-md-4 clo-sm-12 blog-rtl">
    <form>
        <div class="form-group">
            <input type="text" class="form-control search" aria-describedby="search" />
        </div>
        <button type="submit" class="d-none">{{__('utility.submit')}}</button>
    </form>
    <h5 class="mt-4 text-uppercase">{{__('utility.categories')}}</h5>
    <ul class="mt-3 list-unstyled category-links">
        @foreach ($blogCategories as $item)
        <li class="d-flex justify-content-between align-items-center">
            <a href="#">{{$item->name}}</a>
            <span>&gt;</span>
        </li>
        @endforeach
    </ul>
    <h5 class="mt-4 text-uppercase">{{__('utility.recent-posts')}}</h5>
    <ul class="mt-3 list-unstyled category-links">
        @foreach ($latestBlogs as $item)
        <li class="d-flex justify-content-between align-items-center">
            <a href="#">{{substr($item->title, 0, 57)}} ...</a>
            <span class="mx-1">&gt;</span>
        </li>
        @endforeach
    </ul>
</div>
@push('script')
{{--  --}}
@endpush