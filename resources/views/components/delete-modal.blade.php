<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmationLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirm Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="py-3">
                    <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="fs-5">Are you sure you want to delete this <strong class="text-danger">{{$type}}</strong>?</p>
                <p class="text-muted">{{$message}}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i> Cancel
                </button>
                <button type="button" id="confirmDeleteButton" class="btn btn-danger px-4">
                    <i class="bi bi-trash-fill me-2"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); // Prevent form submission
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        modal.show();

        // Attach the delete action to the modal's delete button
        document.getElementById('confirmDeleteButton').onclick = function () {
            document.getElementById(formId).submit();
        };
    }
</script>
