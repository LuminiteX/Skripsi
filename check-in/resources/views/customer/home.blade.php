<x-customer-layout>
    <div class="container-fluid flex-grow-1 p-0">
        <div class="card text-white ">
            <img src="storage/HomeImg/HomeBanner.jpg" alt="Top Picture" class="img-fluid" style="max-height: 300px; object-fit: cover;">
            <div class="card-img-overlay text-center mt-5">
                <h3 class="card-title mt-4">Welcome to Check-In!</h3>
                <p class="card-text mt-4 mb-4">Check-In is a web based application that aims to help you make
                    reservations in restaurants that you want! With Check-In, it's going to be easier to make
                    reservations!</p>
                <a href="{{ route('restaurants.list') }}" class="btn btn-primary">Make your reservation</a>
            </div>
        </div>
        <div class="container bg-white text-body pt-5">
            <div class="row">
                <div class="col mt-5">
                    <h5 class="mt-5">OUR STORY</h5>
                    <h2>Welcome</h2>
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Temporibus nemo incidunt praesentium, ipsum culpa
                        minus eveniet, id nesciunt excepturi sit voluptate
                        repudiandae. Explicabo, incidunt quia. Repellendus
                        mollitia quaerat est voluptas!</h5>
                </div>
                <div class="col mb-5">
                    <img src="storage/HomeImg/Food.jpeg" alt="Food" class="img-fluid" style="max-width: 500px;">
                </div>
            </div>
        </div>
        <div class="container bg-secondary text-white">
            <div class="row">
                <div class="col mt-5">
                    <h5 class="mt-5">About Us</h5>
                    <h1>WHY CHOOSE US?</h1>
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Temporibus nemo incidunt praesentium, ipsum culpa
                        minus eveniet, id nesciunt excepturi sit voluptate
                        repudiandae. Explicabo, incidunt quia. Repellendus
                        mollitia quaerat est voluptas!</h5>
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
                <div class="col mt-5 mb-5">
                    <img src="storage/HomeImg/choose.jpg" alt="choose" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
