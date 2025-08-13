<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3 me-3">Create Attribute</h6>
                </div>
            </div>
            <div class="card-body pt-4 px-4">
                <form method="POST" action="/admin/addAttribute">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Attribute Name</label>
                            <input type="text" id="attribute" name="name" class="form-control" placeholder="Attribute Name"
                                required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn bg-gradient-dark">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

