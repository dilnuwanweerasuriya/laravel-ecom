<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Edit Category</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form method="POST" action="/admin/updateCategory">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Category Name</label>
                            <input type="text" id="category" name="name" class="form-control"
                                value="{{ $category->name }}" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Category Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                value="{{ $category->slug }}" required readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Parent Category</label>
                            <select class="select form-control" name="parent">
                                <option value="">Select parent category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="statusToggle" name="status"
                                    {{ $category->is_active == 1 ? 'checked' : '' }}>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <button type="submit" class="btn bg-gradient-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#category').on('input', function() {
            const category = $(this).val();
            const slug = category
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            $('#slug').val(slug);
        });
    });
</script>
