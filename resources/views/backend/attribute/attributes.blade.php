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
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Attribute</th>
                                <th
                                    class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    Attribute Values</th>
                                <th class="text-secondary text-center opacity-7"></th>
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
                                                {{ $item->value }}@if (!$loop->last), @endif
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
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attributeModalLabel{{ $attribute->id }}">
                                                    Attribute Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Name:</strong> {{ $attribute->name }}</p>
                                                @if ($attribute->attributeValues->isNotEmpty())
                                                    <hr>
                                                    <p><strong>Attribute Values:</strong>
                                                        @foreach ($attribute->attributeValues as $item)
                                                            {{ $item->value }}@if (!$loop->last), @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm bg-gradient-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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
</script>
