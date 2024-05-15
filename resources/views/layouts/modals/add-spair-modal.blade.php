<div class="modal fade" id="addPartModal" tabindex="-1" role="dialog" aria-labelledby="addPartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartModalLabel">Add Spare Part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<form class="form-group" action="{{ route(auth()->user()->role . '.add-parts') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!-- Add form fields for user details -->
                        <div class="form-group">
                            <label for="part_name">Part Name</label>
                            <input type="text" class="form-control" id="part_name" name="part_name" required>
                        </div>
                        <div class="form-group">
                            <label for="part_reference">Part Reference</label>
                            <input type="text" class="form-control" id="part_reference" name="part_reference"
                                required>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control" name="supplier" id="supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="repair_id">Repair ID</label>
                            <input type="text" class="form-control" name="repair_id" id="repair_id" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Spare Part</button>
                    </div>
                </form>
            </div>
        </div>
    </div>