<x-customer-layout>
    <div class="container-fluid flex-grow-1 p-0">
        <div class="card text-white ">
            <img src="storage/HomeImg/HomeBanner.jpg" alt="Top Picture" class="img-fluid"
                style="max-height: 300px; object-fit: cover; width:100%; min-height: 220px">

            <div class="card-img-overlay text-center mt-md-5 mt-xs-0">
                <h3 class="card-title mt-md-4 mt-xs-0">Welcome to Check-In!</h3>
                <p class="card-text mt-md-4 mt-xs-0 mb-md-4 mb-xs-0">Check-In is a web based application that aims to
                    help you
                    make
                    reservations in restaurants that you want! With Check-In, it's going to be easier to make
                    reservations!</p>
                <a href="{{ route('restaurants.list') }}" class="btn btn-primary">Make your reservation</a>
            </div>
        </div>
        <div class="container bg-white text-body pt-5">
            <div class="row">
                <div class="col-md-6 col-xs-12 mt-5 mb-5">
                    <h5>OUR STORY</h5>
                    <h2>Welcome</h2>
                    <h5>People around the world like to eat in restaurants, with most of them making reservations
                        beforehand. We noticed that the reservation process and handling is a bit of a hassle for both
                        restaurant owners as well as customers. With the COVID-19 pandemic happening recently, we have
                        also seen the need for a way to reserve and order menu without physical interaction. Because of
                        that, our team decided to make Check-In so that both restaurnat owners and customers would have
                        an easier time in making and managing reservations.</h5>
                </div>
                <div class="col-md-6 col-xs-12 mb-5 p-2">
                    <img src="storage/HomeImg/Food.jpeg" alt="Food" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="container bg-secondary text-white">
            <div class="row">
                <div class="col-md-6 col-xs-12 col-xs-12 mt-5">
                    <h5 class="mt-5">About Us</h5>
                    <h1>WHY CHOOSE US?</h1>
                    <h5>Our application has a lot of features to help you in making reservations online. Here's the
                        three main reasons on why you should choose Check-In.</h5>
                    <div class="row mt-4">
                        <div class="col-sm-1 text-info">
                            <h5>1.</h5>
                        </div>
                        <div class="col align-self-center">
                            <h5> Easy and Quick Reservation and Menu Ordering</h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-1 text-info">
                            <h5>2.</h5>
                        </div>
                        <div class="col align-self-center">
                            <h5> Multiple Restaurant Choices</h5>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-1 text-info">
                            <h5>3.</h5>
                        </div>
                        <div class="col align-self-center">
                            <h5> Minimal Physical Contact Needed</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 p-2 mt-5 mb-5">
                    <img src="storage/HomeImg/choose.jpg" alt="choose" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
