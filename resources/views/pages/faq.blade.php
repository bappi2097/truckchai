@extends('layouts.master')
@section('content')
<div class="container my-5 text-rtl">
    <div class="text-center">
        <h3 class="testimonial-text">{{__('utility.faq-fullform')}}</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Shipper</h4>
            <div class="mx-auto my-4 accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none" type="button"
                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Quis, fugit.
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This
                            panel is shown by default, thanks to the
                            <code>.show</code> class.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the second accordion panel. This
                            panel is hidden by default.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            And lastly, the placeholder content for the third and final
                            accordion panel. This panel is hidden by default.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Owner</h4>
            <div class="mx-auto my-4 accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none" type="button"
                                data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
                                aria-controls="collapseFour">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                Quis, fugit.
                            </button>
                        </h2>
                    </div>

                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the first accordion panel. This
                            panel is shown by default, thanks to the
                            <code>.show</code> class.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Some placeholder content for the second accordion panel. This
                            panel is hidden by default.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2 class="mb-0">
                            <button class="text-left btn btn-block btn-outline-none collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            And lastly, the placeholder content for the third and final
                            accordion panel. This panel is hidden by default.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection