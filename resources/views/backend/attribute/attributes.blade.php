<style>
    .dataTables_filter input {
        border-radius: 8px;
        padding: 6px 12px;
        border: 1px solid #ccc;
    }

    #attributes-table_filter{
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
</style>

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h6 class="text-white text-capitalize ps-3 me-3">Attributes table</h6>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="/admin/attributes/create" class="btn btn-primary btn-sm me-3">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="attributes-table" class="table align-items-center mb-0 table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Attribute</th>
                                <th class="text-center">Attribute Values</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $attribute)
                                <tr id="attribute-row-{{ $attribute->id }}">
                                    <td class="text-center">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $attribute->name }}</h6>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($attribute->attributeValues->isNotEmpty())
                                            @foreach ($attribute->attributeValues as $item)
                                                {{ $item->value }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <!-- Edit -->
                                        <a href="/admin/attributes/edit/{{ $attribute->id }}"
                                            class="text-secondary font-weight-bold text-xs">
                                            <i class="material-symbols-rounded opacity-5">edit</i>
                                        </a>

                                        <!-- View -->
                                        <a href="javascript:void(0)" class="text-secondary font-weight-bold text-xs"
                                            data-bs-toggle="modal" data-bs-target="#attributeModal{{ $attribute->id }}"
                                            title="View attribute">
                                            <i class="material-symbols-rounded opacity-5">visibility</i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0);" data-id="{{ $attribute->id }}"
                                            class="btn-delete-attribute text-danger font-weight-bold text-xs"
                                            title="Delete attribute">
                                            <i class="material-symbols-rounded opacity-5">delete</i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Attribute Details Modal -->
                                <div class="modal fade" id="attributeModal{{ $attribute->id }}" tabindex="-1"
                                    aria-labelledby="attributeModalLabel{{ $attribute->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow-lg rounded-3 border-0">
                                            <!-- Header -->
                                            <div class="modal-header bg-gradient-dark text-white">
                                                <h5 class="modal-title d-flex align-items-center text-white"
                                                    id="attributeModalLabel{{ $attribute->id }}">
                                                    <i class="material-symbols-rounded me-2">tune</i>
                                                    Attribute Details
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <!-- Attribute Name -->
                                                <div class="mb-3">
                                                    <h6 class="text-dark fw-bold mb-2"><i
                                                            class="material-symbols-rounded me-1">label</i> Attribute
                                                        Name</h6>
                                                    <p class="fs-6 text-dark">{{ $attribute->name }}</p>
                                                </div>

                                                <!-- Attribute Values -->
                                                @if ($attribute->attributeValues->isNotEmpty())
                                                    <hr>
                                                    <h6 class="text-dark fw-bold mb-2"><i
                                                            class="material-symbols-rounded me-1">list</i> Attribute
                                                        Values</h6>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($attribute->attributeValues as $item)
                                                            <span
                                                                class="badge bg-light text-dark border">{{ $item->value }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-outline-secondary"
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
        $('#attributes-table').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false, // Disable sorting for now
            info: true,
            responsive: true,
            dom: '<"row mb-3"<"col-md-6 d-flex align-items-center"l><"col-md-6 d-flex justify-content-end"f>>t<"row mt-3"<"col-md-6"i><"col-md-6 d-flex justify-content-end"p>>',
            language: {
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ attributes",
                infoEmpty: "No attributes available",
                infoFiltered: "(filtered from _MAX_ total attributes)",
                zeroRecords: "No matching attributes found",
                search: "",
                searchPlaceholder: "🔍 Search attributes...",
                paginate: {
                    previous: "←",
                    next: "→"
                }
            }
        });

        // Delete functionality remains same
        $(document).on('click', '.btn-delete-attribute', function(e) {
            e.preventDefault();
            var attributeId = $(this).data('id');

            if (!confirm('Are you sure you want to delete this attribute?')) return;

            $.ajax({
                url: '/admin/attributes/delete/' + attributeId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#attribute-row-' + attributeId).fadeOut(300, function() {
                        $(this).remove();
                    });

                    toastr.success('Attribute deleted successfully.');
                },
                error: function() {
                    toastr.error('Failed to delete attribute.');
                }
            });
        });
    });
</script>
