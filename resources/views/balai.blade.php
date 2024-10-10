@extends('layout.header')
@section('content')
    @include('layout.balai-navbar')
    @if (Auth::check())
        @include('resort.chatlist')
    @endif

    <style>


        .banner_area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Adjust opacity to make it darker/lighter */
            z-index: -1; /* Keep the overlay behind the content */
        }
    </style>


    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay banner_area"  style="background: url('{{ asset('images/background.png') }}')" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h6>Away from monotonous life</h6>
                    <h2>Relax Your Mind</h2>
                    <p>If you are looking at blank cassettes on the web, you may be very confused at the<br> difference in
                        price. You may see some for as low as $.17 each.</p>
                    <a href="#" class="btn theme_btn button_hover">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!--================Banner Area =================-->
    <div class="">
        <div class="shadow-lg mb-5 bg-white rounded">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs justify-content-center" id="bookingTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                        aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="room-tab" data-toggle="tab" href="#room" role="tab" aria-controls="room"
                        aria-selected="false">Room</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event"
                        aria-selected="false">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="menus-tab" data-toggle="tab" href="#menus" role="tab" aria-controls="menus"
                        aria-selected="false">Menus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                        aria-controls="review" aria-selected="false">Review</a>
                </li>
            </ul>

            <style>
                .sticky-nav {
                    margin-top: 80px;
                    position: fixed;
                    top: 0;
                    width: 100%;
                    z-index: 1000;
                    background-color: white;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                /* Placeholder to prevent content jump */
                .sticky-placeholder {
                    height: 50px;
                }

                /* Mobile view adjustment */
                @media (max-width: 767px) {
                    .sticky-nav {
                        margin-top: 0;
                    }

                    .sticky-placeholder {
                        height: 0;
                    }
                }

                /* Make nav links bold and control colors */
                .nav-tabs .nav-link {
                    font-weight: bold;
                    font-size: 1.1rem;
                    /* Slightly larger text */
                    color: black;
                    /* Default color for inactive tabs */
                }

                /* Active tab styling */
                .nav-tabs .nav-link.active {
                    color: blue;
                    /* Set active tab color to blue */
                }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var navbar = document.getElementById("bookingTab");
                    var stickyOffset = navbar.offsetTop;

                    window.onscroll = function() {
                        if (window.pageYOffset >= stickyOffset) {
                            navbar.classList.add("sticky-nav");
                            navbar.parentElement.classList.add(
                                "sticky-placeholder");
                        } else {
                            navbar.classList.remove("sticky-nav");
                            navbar.parentElement.classList.remove("sticky-placeholder");
                        }
                    };
                });
            </script>



            <!-- Tab panes -->
            <div class="tab-content mt-4 bg-light rounded">
                <!-- Overview -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <!--================ Accomodation Area  =================-->
                    <section class="accomodation_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 class="title_color">Resort Accommodation</h2>
                                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely
                                    fast,</p>
                            </div>
                            <style>
                                .row1 {
                                    display: -ms-flexbox;
                                    display: flex;
                                    -ms-flex-wrap: wrap;
                                    flex-wrap: wrap;
                                    margin-right: -15px;
                                    margin-left: -15px;
                                    flex-direction: row;
                                    justify-content: center;
                                    align-content: stretch;
                                }
                            </style>
                            <div class="row1 mb_30 room-slider">
                                @foreach ($rooms as $room)
                                    @if ($room->status !== 'offline')
                                        <!-- Check if room status is not 'offline' -->
                                        <div class="col-lg-3 col-sm-6 room-item">
                                            <div class="accomodation_item text-center">
                                                <!-- Initialize Owl Carousel for individual room images -->
                                                <div class="owl-carousel hotel_img">
                                                    @foreach ($room->images as $image)
                                                        <div>
                                                            <img src="{{ asset('storage/images/' . $image->path) }}"
                                                                alt="Room Image">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a href="#">
                                                    <h4 class="sec_h4">{{ $room->name }}</h4>
                                                </a>
                                                <p>We all live in an age that belongs to the young at heart. Life that is
                                                    becoming extremely fast,</p>
                                                <h5>${{ $room->price }}<small>/night</small></h5>
                                                <a href="{{ route('room.book', $room->id) }}"
                                                    class="btn theme_btn button_hover">Book Now</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </section>
                    <!--================ Accomodation  End Area  =================-->
                    <!--================ Event Area =================-->
                    <section class="facilities_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 style="color: white">Event</h2>
                            </div>

                            @if ($events->isEmpty())
                                <div class="row mb-5">
                                    <div class="col-md-12 text-center">
                                        <h3 class="text-white">No events available</h3>
                                    </div>
                                </div>
                            @else
                                @foreach ($events as $event)
                                    <div class="row mb-5">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <div class="about_content">
                                                <h2 class="title title_color text-white">{{ $event->event_name }}</h2>
                                                <p class="text-white">
                                                    {{ $event->description ?? 'No description available' }}
                                                </p>

                                                @if ($event->discount)
                                                    <h4 class="text-white">
                                                        P{{ number_format($event->price, 2) }}
                                                        <span>{{ $event->discount }}% off</span>
                                                    </h4>
                                                @else
                                                    <h4 class="text-white">P{{ number_format($event->price, 2) }}</h4>
                                                @endif

                                                <p class="text-white">
                                                    From: {{ $event->event_start->format('M d, Y') }} to
                                                    {{ $event->event_end->format('M d, Y') }}
                                                </p>

                                                <a href="#" class="button_hover theme_btn_two">Book Now</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="hotel_img owl-carousel owl-theme">
                                                @foreach ($event->eventImages as $image)
                                                    <div class="item">
                                                        <img class="img-fluid" style="width: 100%; height: 486px;"
                                                            src="{{ asset('storage/images/' . $image->path) }}"
                                                            alt="{{ $event->event_name ?? 'Event Image' }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </section>


                    <!--================ Event Area End =================-->
                    <section class="accomodation_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 class="title_color">Menus</h2>
                                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely
                                    fast,</p>
                            </div>

                            <!-- Loop through each category -->
                            @foreach ($categories as $category)
                                <!-- Check if the category has any menus in its subcategories -->
                                @php
                                    $hasMenus = false;
                                    foreach ($category->subcategories as $subcategory) {
                                        if ($subcategory->menus->isNotEmpty()) {
                                            $hasMenus = true;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($hasMenus)
                                    <div class="text-center">
                                        <h2>{{ $category->name }}</h2> <!-- Display Category Name -->
                                    </div>

                                    <!-- Loop through each subcategory -->
                                    @foreach ($category->subcategories as $subcategory)
                                        <!-- Check if the subcategory has any menus -->
                                        @if ($subcategory->menus->isNotEmpty())
                                            <h3>{{ $subcategory->name }}</h3> <!-- Display SubCategory Name -->

                                            <div class="row accomodation_two">
                                                <!-- Loop through each menu under the subcategory -->
                                                @foreach ($subcategory->menus as $menu)
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="accomodation_item text-center">
                                                            <div class="hotel_img">
                                                                @if ($menu->images->first())
                                                                    <img src="{{ asset('storage/images/' . $menu->images->first()->path) }}"
                                                                        alt="Menu Image"> <!-- Display Menu Image -->
                                                                @else
                                                                    <img src="{{ asset('storage/default.jpg') }}"
                                                                        alt="Default Image"> <!-- Default Image -->
                                                                @endif
                                                                <a href="#" class="btn theme_btn button_hover"
                                                                    style="padding:5px 17px;">Reserve Now</a>
                                                            </div>
                                                            <a href="#">
                                                                <h4 class="sec_h4">{{ $menu->name }}</h4>
                                                            </a> <!-- Menu Name -->
                                                            <p>{{ $menu->description }}</p>
                                                            <h5>{{ $menu->price }}<small></small></h5> <!-- Menu Price -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </section>

<!--================ Testimonial Area  =================-->
<section class="testimonial_area section_gap">
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_color">Testimonial from our Clients</h2>
            <p>The French Revolution constituted for the conscience of the dominant aristocratic class a
                fall from </p>
        </div>
        <div class="testimonial_slider owl-carousel">

            @foreach ($reviews as $review)
    <div class="media testimonial_item">
        <img class="rounded-circle" src="{{ asset('images/default-avatar.png') }}" alt="User Image">
        <div class="media-body">
            <p>{{ $review->review }}</p>
            <a href="#">
                <h4 class="sec_h4">{{ $review->user->name }}</h4>
            </a>
            <div class="star">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <a href="#"><i class="fa fa-star text-yellow-500"></i></a>
                    @else
                        <a href="#"><i class="fa fa-star-o"></i></a>
                    @endif
                @endfor
            </div>
        </div>
    </div>
@endforeach
            <style>
                .star a {
    margin: 0 2px; /* Adds some spacing between stars */
}

.media {
    display: flex;
    align-items: center; /* Aligns the items in the center vertically */
}

.rounded-circle {
    width: 50px; /* Adjust width as necessary */
    height: 50px; /* Adjust height as necessary */
    margin-right: 15px; /* Space between image and text */
}

            </style>


        </div>
    </div>
</section>
<!--================ Testimonial Area  =================-->

                </div>



                <!-- Room -->
                <div class="tab-pane fade" id="room" role="tabpanel" aria-labelledby="room-tab">
                    <!--================ Accomodation Area  =================-->
                    <section class="accomodation_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 class="title_color">Resort Accomodation</h2>
                                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely
                                    fast, </p>
                            </div>
                            <div class="row mb_30">
                                @foreach ($rooms as $room)
                                    @if ($room->status !== 'offline')
                                        <!-- Check if room status is not 'offline' -->
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="accomodation_item text-center">
                                                <div class="owl-carousel hotel_img">
                                                    @foreach ($room->images as $image)
                                                        <div>
                                                            <img src="{{ asset('storage/images/' . $image->path) }}"
                                                                alt="Room Image">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a href="#">
                                                    <h4 class="sec_h4">{{ $room->name }}</h4>
                                                </a>
                                                <p>We all live in an age that belongs to the young at heart. Life that is
                                                    becoming extremely fast, </p>
                                                <h5>${{ $room->price }}<small>/night</small></h5>
                                                <a href="{{ route('room.book', $room->id) }}"
                                                    class="btn theme_btn button_hover">Book Now</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>

                        </div>
                    </section>
                    <!--================ Accomodation Area  =================-->

                </div>



                <!-- Event -->
                <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">
                    <!--================ Event Area =================-->
                    <section class="facilities_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 style="color: white">Event</h2>
                            </div>

                            @if ($events->isEmpty())
                                <div class="row mb-5">
                                    <div class="col-md-12 text-center">
                                        <h3 class="text-white">No events available</h3>
                                    </div>
                                </div>
                            @else
                                @foreach ($events as $event)
                                    <div class="row mb-5">
                                        <div class="col-md-6 d-flex align-items-center">
                                            <div class="about_content">
                                                <h2 class="title title_color text-white">{{ $event->event_name }}</h2>
                                                <p class="text-white">
                                                    {{ $event->description ?? 'No description available' }}
                                                </p>

                                                @if ($event->discount)
                                                    <h4 class="text-white">
                                                        P{{ number_format($event->price, 2) }}
                                                        <span>{{ $event->discount }}% off</span>
                                                    </h4>
                                                @else
                                                    <h4 class="text-white">P{{ number_format($event->price, 2) }}</h4>
                                                @endif

                                                <p class="text-white">
                                                    From: {{ $event->event_start->format('M d, Y') }} to
                                                    {{ $event->event_end->format('M d, Y') }}
                                                </p>

                                                <a href="#" class="button_hover theme_btn_two">Book Now</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="hotel_img owl-carousel owl-theme">
                                                @foreach ($event->eventImages as $image)
                                                    <div class="item">
                                                        <img class="img-fluid" style="width: 100%; height: 486px;"
                                                            src="{{ asset('storage/images/' . $image->path) }}"
                                                            alt="{{ $event->event_name ?? 'Event Image' }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </section>




                    <!--================ Event Area End =================-->
                </div>



                <!-- Menus -->
                <div class="tab-pane fade" id="menus" role="tabpanel" aria-labelledby="menus-tab">
                    <section class="accomodation_area section_gap">
                        <div class="container">
                            <div class="section_title text-center">
                                <h2 class="title_color">Menus</h2>
                                <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely
                                    fast,</p>
                            </div>

                            <!-- Loop through each category -->
                            @foreach ($categories as $category)
                                <!-- Check if the category has any menus in its subcategories -->
                                @php
                                    $hasMenus = false;
                                    foreach ($category->subcategories as $subcategory) {
                                        if ($subcategory->menus->isNotEmpty()) {
                                            $hasMenus = true;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($hasMenus)
                                    <div class="text-center">
                                        <h2>{{ $category->name }}</h2> <!-- Display Category Name -->
                                    </div>

                                    <!-- Loop through each subcategory -->
                                    @foreach ($category->subcategories as $subcategory)
                                        <!-- Check if the subcategory has any menus -->
                                        @if ($subcategory->menus->isNotEmpty())
                                            <h3>{{ $subcategory->name }}</h3> <!-- Display SubCategory Name -->

                                            <div class="row accomodation_two">
                                                <!-- Loop through each menu under the subcategory -->
                                                @foreach ($subcategory->menus as $menu)
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="accomodation_item text-center">
                                                            <div class="hotel_img">
                                                                @if ($menu->images->first())
                                                                    <img src="{{ asset('storage/images/' . $menu->images->first()->path) }}"
                                                                        alt="Menu Image"> <!-- Display Menu Image -->
                                                                @else
                                                                    <img src="{{ asset('storage/default.jpg') }}"
                                                                        alt="Default Image"> <!-- Default Image -->
                                                                @endif
                                                                <a href="#" class="btn theme_btn button_hover"
                                                                    style="padding:5px 17px;">Reserve Now</a>
                                                            </div>
                                                            <a href="#">
                                                                <h4 class="sec_h4">{{ $menu->name }}</h4>
                                                            </a> <!-- Menu Name -->
                                                            <p>{{ $menu->description }}</p>
                                                            <h5>{{ $menu->price }}<small></small></h5> <!-- Menu Price -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </section>

                </div>





                <!-- Review -->
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

                </div>
            </div>
        </div>
    </div>
@endsection
