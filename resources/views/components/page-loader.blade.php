<div id="spinner-overlay">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
</div>

  <script>
    $(window).on('load', function() {
        $('#spinner-overlay').fadeOut('slow'); // Hides the spinner with a fade effect
    });
  </script>