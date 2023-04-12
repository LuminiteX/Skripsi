<x-customer-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="padding: 0;">
                <img src="{{ Storage::url($restaurants->image) }}" class="img-fluid"
                    style="width: 100%; height: 300px; object-fit: cover;">
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-0">{{ $restaurants->name }}</h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center mt-sm-2 mt-xs-2">
                    <a href="{{ route('reservations.step.one', $restaurants->id) }}"
                        class="btn btn-primary me-3">Reserve
                        Now</a>
                    <div class="rating-section me-2 me-md-3">
                        <p class="card-text mb-0"">
                            Rating:
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $restaurants->rating)
                                    <i class="fas fa-star text-warning" style="color: gold;"></i>
                                @elseif($i == ceil($restaurants->rating))
                                    <i class="fas fa-star-half-alt text-warning" style="color: gold;"></i>
                                @else
                                    <i class="far fa-star text-warning" style="color: gold;"></i>
                                @endif
                            @endfor
                        </p>
                    </div>
                    <div class="views-section ms-md-3">
                        <i class="fas fa-eye me-1"></i>
                        <span>{{ $restaurants->view }} views</span>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-md-12 mt-2">
            <h5 class="fw-bold mb-0">Opening Time</h5>
            <p class="mb-4 mt-2 fs-6"> Restaurant Opens at <strong>{{ $formattedTimeOpening }} -
                    {{ $formattedTimeClosing }}</strong></p>

        </div>

        <div class="col-md-12 mt-2">
            <h5 class="fw-bold mb-0">Description </h5>
            <p class="mb-4 mt-2">{{ $restaurants->description }}</p>
            <div class="mb-4">
                <h5 class="fw-bold mb-3">Contact Us</h5>
                <p>Phone: {{ $restaurants->phone_number }}</p>
                <p>Email: {{ $restaurants->user->email }}</p>
            </div>
            <h5 class="fw-bold mb-3">Address</h5>
            <p>{{ $restaurants->address }}</p>
        </div>
        <div class="col-md-12 row mt-5">
            <div class="col-md-12 mb-2">
                <h5 class="fw-bold mb-3">Menu</h5>
                <div class="row row-cols-1 row-cols-md-3 g-3">
                    @foreach ($menus as $menu)
                        <div class="col">
                            <div class="card h-100">
                                <div class="row g-0 align-items-center">
                                    <div class="col-md-4 p-2">
                                        <img src="{{ Storage::url($menu->image) }}"
                                            class="img-fluid rounded-start mx-auto d-block" alt="{{ $menu->name }}"
                                            style="max-height: 200px;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $menu->name }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($menu->chef_recommendation)
                                                    <span class="badge bg-warning text-dark">Chef Recommendation</span>
                                                @endif
                                            </div>
                                            <p class="card-text">
                                                {{ \Illuminate\Support\Str::limit($menu->description, 200, $end = '...') }}
                                            </p>
                                            <p class="card-text"><small class="text-muted">Price =
                                                    {{ 'Rp ' . number_format($menu->price, 0, ',', '.') }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $menus->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <div class="col-md-12 row mt-5">
                <div class="col-md-12">
                    <h5 class="fw-bold mb-3">Graph</h5>
                    <div id="chart3"></div>
                </div>
            </div>
            <div class="col-md-12 row mt-5">
                <div class="col-md-12">
                    <h5 class="fw-bold mb-3">Comment</h5>
                    <div class="container py-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title mb-4">Comment Section</h2>
                                <div class="mb-5">
                                    @foreach ($comments as $comment)
                                        <div class="w-96 mb-4">
                                            <img src="{{ Storage::url($comment->user->image) }}" alt="User"
                                                class="rounded-circle me-2 border" style="width: 50px; height: 50px;">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <h5 class="mb-0 me-2">{{ $comment->user->name }}</h5>
                                                    <small
                                                        class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-0">{{ $comment->comment }}</p>
                                                <div class="d-flex align-items-center mt-3">
                                                    @if ($comment->user->id == auth()->user()->id)
                                                        <form
                                                            action="{{ route('customer.comments.reply.destroy', ['comments' => $comment->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger me-2">Delete</button>
                                                        </form>
                                                    @endif
                                                    <button type="button" class="btn btn-primary me-2"
                                                        onclick="toggleCommentForm({{ $comment->id }})">Reply</button>
                                                </div>
                                                <div class="d-none" id="comment-form-{{ $comment->id }}">
                                                    <form
                                                        action="{{ route('customer.comments.reply', $restaurants->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="comment_id"
                                                            value="{{ $comment->id }}">
                                                        <div class="d-flex align-items-end mb-3 mt-3">
                                                            <div class="flex-grow-1 me-3">
                                                                <textarea name="comment" class="form-control" placeholder="Leave a comment" style="height: 100px;"></textarea>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach ($comment->child()->orderBy('created_at', 'desc')->get() as $child)
                                            <div class="d-flex mb-2 ms-5">
                                                <img src="{{ Storage::url($child->user->image) }}" alt="User"
                                                    class="rounded-circle me-2 border"
                                                    style="width: 50px; height: 50px;">
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <h5 class="mb-0 me-2">{{ $child->user->name }}</h5>
                                                        <small class="text-muted">5 minutes ago</small>
                                                    </div>
                                                    <p class="mb-0">{{ $child->comment }}</p>
                                                    @if ($child->user->id == auth()->user()->id)
                                                        <form
                                                            action="{{ route('customer.comments.reply.destroy', ['comments' => $child->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger mt-2">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <form action="{{ route('customer.comments.send', $restaurants->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <textarea name="comment" class="form-control" placeholder="Leave a comment" style="height: 100px;"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCommentForm(commentId) {
            var commentForm = document.getElementById('comment-form-' + commentId);
            if (commentForm.classList.contains('d-none')) {
                commentForm.classList.remove('d-none');
            } else {
                commentForm.classList.add('d-none');
            }
        }
    </script>


    <script>
        var chartData3 = <?php echo json_encode($chartData3); ?>;

        Highcharts.chart('chart3', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'The amount of reservation in <?php echo $restaurants->name; ?>'
            },
            xAxis: {
                categories: chartData3.categories,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Reservation'
                }
            },

            series: [{
                name: 'Reservations',
                data: chartData3.data

            }]
        }, function(chart3) { // callback function to customize legend
            var legendItems = chart.legend.allItems;
            for (var i = 0; i < legendItems.length; i++) {
                legendItems[i].color = chart2.series[0].color;
            }
        });
    </script>
</x-customer-layout>
