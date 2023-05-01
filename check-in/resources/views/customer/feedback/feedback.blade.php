<x-customer-layout>
    @section('style')
        <style>
            #rating-value {
                width: 200px;
                margin: 40px auto 0;
                padding: 10px 5px;
                text-align: center;
                box-shadow: inset 0 0 2px 1px rgba(46, 204, 113, .2);
            }

            /*styling star rating*/
            .rating {
                border: none;
                float: left;
            }

            .rating>input {
                display: none;
            }

            .rating>label:before {
                content: '\f005';
                font-family: FontAwesome;
                margin: 5px;
                font-size: 1.5rem;
                display: inline-block;
                cursor: pointer;
            }

            .rating>.half:before {
                content: '\f089';
                position: absolute;
                cursor: pointer;
            }


            .rating>label {
                color: #ddd;
                float: right;
                cursor: pointer;
            }

            .rating>input:checked~label,
            .rating:not(:checked)>label:hover,
            .rating:not(:checked)>label:hover~label {
                color: gold;
            }

            .rating>input:checked+label:hover,
            .rating>input:checked~label:hover,
            .rating>label:hover~input:checked~label,
            .rating>input:checked~label:hover~label {
                color: gold;
            }

            .form-group label {
                text-align: left;
                display: block;
            }

            h1.text-center {
                text-align: left;
            }

            h1 {
                text-align: left;
            }
        </style>
    @endsection

    <div class="container mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11 p-0 m-0">
                    <h1>Please give a rating to this restaurant</h1>
                </div>
                <div class="col-md-1 d-flex justify-content-end">
                    <a href="{{ route('reservations.history') }}"><button type="button"
                            class="btn btn-secondary">Back</button></a>
                </div>
            </div>
        </div>
        <form action="{{ route('reservations.feedback.store', $reservation->id) }}" method="POST">
            @csrf

            @error('rating')
                <div class="text-md text-danger"><b>{{ $message }}</b></div>
            @enderror

            <div class="col-md-12 d-flex tex-center justify-content-center mt-3 mb-5">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5"
                        class="full" title="Awesome"></label>
                    <input type="radio" id="star4.5" name="rating" value="4.5" /><label for="star4.5"
                        class="half"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4"
                        class="full"></label>
                    <input type="radio" id="star3.5" name="rating" value="3.5" /><label for="star3.5"
                        class="half"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3"
                        class="full"></label>
                    <input type="radio" id="star2.5" name="rating" value="2.5" /><label for="star2.5"
                        class="half"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2"
                        class="full"></label>
                    <input type="radio" id="star1.5" name="rating" value="1.5" /><label for="star1.5"
                        class="half"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1"
                        class="full"></label>
                    <input type="radio" id="star0.5" name="rating" value="0.5" /><label for="star0.5"
                        class="half"></label>
                </fieldset>
            </div>

            <div class="comment-form text-center mt-5">
                <div class="form-group">
                    <label for="comment">
                        <h2>Comment:</h2>
                    </label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let star = document.querySelectorAll('input');
        let showValue = document.querySelector('#rating-value');

        for (let i = 0; i < star.length; i++) {
            star[i].addEventListener('click', function() {
                i = this.value;

                showValue.innerHTML = i + " out of 5";
            });
        }
    </script>
    <style>
        .back-button {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 20px;
            margin-right: 20px;
        }
    </style>
</x-customer-layout>
