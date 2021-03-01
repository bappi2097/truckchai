<div id="why-blogs-spinner" class="row justify-content-center my-5">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="container py-5 my-5 text-center d-none" id="why-blogs-div">
    <h3>{{ __('frontend/home.why-choose-traincu') }}</h3>
    <div class="mt-4 d-flex justify-content-center align-items-center">
        <span class="line"></span>
        <span class="square"></span>
        <span class="line"></span>
    </div>
    <div class="why-blogs">

    </div>
    <a href="javascript::void(0)" class="mt-5 btn btn-outline-indigo why-blogs-load">{{ __('utility.more') }}</a>
</div>

@push('script')
<script>
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        // $(document).on("load", whyBlogs());
        $("why-blogs-load").on("click", whyBlogs());
        function whyBlogs(){
            $.ajax({
                url: "{{route('why-blogs')}}",
                type: 'GET',
                success: function( data ){
                    if(!$.isEmptyObject(data)){
                        $("#why-blogs-div").removeClass("d-none");
                    }
                    $("#why-blogs-spinner").addClass("d-none");
                    data.data.forEach((element) => {
                        $(".why-blogs").append(
                            `
                            <div class="row custom-index-blog">
                                <div class="mt-5 row">
                                    <div class="p-0 col-md-5 col-sm-12">
                                        <img class="img-fluid w-100" src="{{ asset( '${element.image}') }}" alt="${element.title}" />
                                    </div>
                                    <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                                        <h5 class="custom-index-blog-title">
                                            <a href="#">
                                                ${element.title}
                                            </a>
                                        </h5>
                                        <div class="custom-index-blog-admin">
                                            <p>{{ __('utility.by') }}:: Admin</p>
                                            <p class="mx-2">{{ __('utility.comments') }}:: 0</p>
                                        </div>
                                        <div>
                                            <span class="seperator"></span>
                                            <span class="ml-3 seperator"></span>
                                        </div>
                                        <p class="custom-index-blog-p">
                                            ${element.description}
                                            […]
                                        </p>
                                    </div>
                                </div>
                                <div class="custom-index-blog-date">
                                    <span class="text-wrap">
                                        ${element.created.split(' ').join("<br>")}
                                    </span>
                                </div>
                            </div>
                            `
                        );
                    })
                }
            });
        }
    });
</script>
@endpush