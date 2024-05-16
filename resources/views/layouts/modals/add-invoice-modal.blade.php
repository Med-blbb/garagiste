<div class="modal fade" id="addInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Add Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth()->user()->role =='admin')
            <form id="addInvoiceForm" action="{{ route('admin.add-invoice') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="additional_charges">Additional Charges</label>
                        <input type="text" class="form-control" id="additional_charges" name="additional_charges" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="repair_id">Repair ID</label>
                        <input type="text" class="form-control" name="repair_id" id="repair_id" required>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="text" class="form-control" name="client_id" id="client_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Invoice</button>
                </div>
            </form>
            @endif
            @if(auth()->user()->role =='mechanic')
            <form id="addInvoiceForm" action="{{ route('mechanic.add-invoice') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="additional_charges">Additional Charges</label>
                        <input type="text" class="form-control" id="additional_charges" name="additional_charges" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="repair_id">Repair ID</label>
                        <input type="text" class="form-control" name="repair_id" id="repair_id" required>
                    </div>
                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="text" class="form-control" name="client_id" id="client_id" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Invoice</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
