<!-- Overlay -->
<div id="DynamicAlertOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 1040;"></div>

<!-- Alert Box -->
<div id="DynamicAlertBox" class="alert alert-{{$alertType}} shadow alert-dismissible position-absolute top-50 start-50 translate-middle m-0 fade show" role="alert" style="z-index: 1050;">
    <p class="m-0">
        <strong>{!! $alertIcon !!} {{$alertReason}}</strong>
        <br> 
        {{$alertMessage}}
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
    // Automatically close the alert after 3 seconds and remove the overlay
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert('#DynamicAlertBox');
        bsAlert.close();

        // Remove the overlay after the alert is closed
        const overlay = document.getElementById('DynamicAlertOverlay');
        if (overlay) {
            overlay.remove();
        }
    }, 3000);

    // Close the overlay manually when the alert's close button is clicked
    document.querySelector('#DynamicAlertBox .btn-close').addEventListener('click', () => {
        const overlay = document.getElementById('DynamicAlertOverlay');
        if (overlay) {
            overlay.remove();
        }
    });
</script>
