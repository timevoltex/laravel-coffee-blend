@extends('layouts.app')
@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{asset("assets/images/bg_3.jpg")}});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Write Review</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span>
                            <span>Write Review</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <form method="post" action="{{route('process.write.review')}}"
                          class="billing-form ftco-bg-dark p-3 p-md-5">
                        @csrf
                        <h3 class="mb-4 billing-heading">Write Review</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="review">Write Review</label>
                                    <textarea rows="10" cols="10" type="text" name="review" class="form-control"
                                              placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" class="form-control" placeholder=""
                                           value="{{Auth::user()->id}}">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <button name="submit" type="submit" class="btn btn-primary py-3 px-4">Write
                                            review
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->


                </div> <!-- .col-md-8 -->


            </div>

        </div>
    </section> <!-- .section -->
@endsection
