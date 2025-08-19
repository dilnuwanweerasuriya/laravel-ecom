<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #reviews-table_filter {
        padding-right: 20px;
    }

    .dataTables_length select {
        border-radius: 8px;
        padding: 4px 8px;
    }

    .page-item.active .page-link {
        background-color: #191919 !important;
        border-color: #191919 !important;
    }

    .hover-shadow:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
        transition: all 0.3s ease-in-out;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.85rem;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h6 class="text-white text-capitalize ps-3 me-3">Reviews table</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="reviews-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Review ID</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                @php
                                    $rating = $review->rating;
                                @endphp

                                <tr id="review-row-{{ $review->id }}">
                                    <td class="text-center">
                                        <div class="px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"># {{ $review->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $review->user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            {{ $review->product->name }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-capitalize">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating)
                                                    <i class="material-symbols-rounded text-warning"
                                                        style="font-size: 20px;">star</i>
                                                @else
                                                    <i class="material-symbols-rounded text-muted"
                                                        style="font-size: 20px;">star</i>
                                                @endif
                                            @endfor
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        @if ($review->is_approved == 0)
                                            <a href="javascript:void(0);" data-id="{{ $review->id }}"
                                                class="btn-approve-review text-success font-weight-bold text-xs"
                                                title="Approve review">
                                                <i class="material-symbols-rounded opacity-5">check</i>
                                            </a>

                                            <a href="javascript:void(0);" data-id="{{ $review->id }}"
                                                class="btn-disapprove-review text-danger font-weight-bold text-xs"
                                                title="Disapprove review">
                                                <i class="material-symbols-rounded opacity-5">close</i>
                                            </a>
                                        @elseif($review->is_approved == 1)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-dark">Disapproved</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- <!-- Edit -->
                                        <a href="/admin/reviews/edit/{{ $review->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a> --}}

                                        <!-- View (opens modal) -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#reviewModal{{ $review->id }}"
                                            title="View review">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete (with JS confirm) -->
                                        <a href="javascript:void(0);" data-id="{{ $review->id }}"
                                            class="btn-delete-review text-danger font-weight-bold text-xs"
                                            title="Delete review">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>


                                <!-- review Details Modal -->
                                <div class="modal fade" id="reviewModal{{ $review->id }}" tabindex="-1"
                                    aria-labelledby="reviewModalLabel{{ $review->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-4 border-0">

                                            <!-- Header -->
                                            <div class="modal-header bg-dark text-white py-3 rounded-top">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="reviewModalLabel{{ $review->id }}">
                                                    <i class="material-symbols-rounded me-2 fs-4">inventory_2</i>
                                                    Review Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body p-4">

                                                <!-- General Info Card -->
                                                <div class="mb-4 p-4 bg-light rounded-4 shadow-sm">
                                                    <h6 class="text-dark fw-bold mb-3 d-flex align-items-center">
                                                        <i class="material-symbols-rounded me-2">info</i> General
                                                        Information
                                                    </h6>

                                                    <div class="mb-2">
                                                        @if ($review->is_approved == 1)
                                                            <span class="badge bg-success">Approved</span>
                                                        @elseif($review->is_approved == 2)
                                                            <span class="badge bg-dark">Disapproved</span>
                                                        @else
                                                            <span class="badge bg-warning">Pending</span>
                                                        @endif
                                                    </div>

                                                    <div class="row gy-2">
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>Review ID:</strong>
                                                                #{{ $review->id }}</p>
                                                            <p class="mb-1"><strong>User:</strong>
                                                                {{ $review->user->name }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1"><strong>Product:</strong>
                                                                {{ $review->product->name }}</p>
                                                            <p class="mb-1 d-flex align-items-center">
                                                                <strong class="me-2">Rating:</strong>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $rating)
                                                                        <i class="material-symbols-rounded text-warning"
                                                                            style="font-size: 20px;">star</i>
                                                                    @else
                                                                        <i class="material-symbols-rounded text-muted"
                                                                            style="font-size: 20px;">star</i>
                                                                    @endif
                                                                @endfor
                                                            </p>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <p class="mb-0"><strong>Comment:</strong></p>
                                                            <div class="p-3 bg-white border rounded-3 text-muted small">
                                                                {{ $review->comment }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer bg-light py-3 rounded-bottom">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                    <i class="material-symbols-rounded me-1">close</i> Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#reviews-table').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false,
            info: true,
            responsive: true,
            dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex justify-content-end"f>>t<"row mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ reviews",
                infoEmpty: "No reviews available",
                infoFiltered: "(filtered from _MAX_ total reviews)",
                zeroRecords: "No matching reviews found",
                search: "",
                searchPlaceholder: "🔍 Search reviews...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });

        $(document).on('click', '.btn-delete-review', function(e) {
            e.preventDefault();
            var reviewId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this review?')) return;

            $.ajax({
                url: '/admin/reviews/delete/' + reviewId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#review-row-' + reviewId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Review deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete review.');
                }
            });
        });

        $(document).on('click', '.btn-approve-review', function(e) {
            e.preventDefault();
            var reviewId = $(this).data('id');

            if (!confirm('Are you sure you want to approve this review?')) return;

            $.ajax({
                url: '/admin/reviews/approve/' + reviewId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Review approved successfully.');
                    location.reload();
                },
                error: function() {
                    toastr.error('Failed to approve review.');
                }
            });
        });

        $(document).on('click', '.btn-disapprove-review', function(e) {
            e.preventDefault();
            var reviewId = $(this).data('id');

            if (!confirm('Are you sure you want to disapprove this review?')) return;

            $.ajax({
                url: '/admin/reviews/disapprove/' + reviewId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    toastr.success('Review disapproved successfully.');
                    location.reload();
                },
                error: function() {
                    toastr.error('Failed to disapprove review.');
                }
            });
        });
    });
</script>
