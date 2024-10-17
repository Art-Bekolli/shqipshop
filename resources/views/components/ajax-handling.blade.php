<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>



<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Function to load posts based on the dropdown value and load state
        function loadPosts(selectedValue, selectedLoad) { // Added selectedLoad parameter
            $.ajax({
                url: my_ajax_object.ajax_url, // WordPress AJAX URL
                type: 'POST', // Fixed missing comma
                data: {
                    action: 'filter_posts', // Action name for WordPress to hook
                    selected_value: selectedValue,
                    selected_load: selectedLoad // Correctly use selectedLoad
                },
                success: function(response) {
                    $('#posts-container').html(response); // Update the posts container with the response
                },
                error: function() {
                    alert('Error loading posts.');
                }
            });
        }

        // Load posts based on the current dropdown value on page load
        var initialValue = $('#orderby').val();
        var initialLoad = '0'; // Define initialLoad value here
        loadPosts(initialValue, initialLoad);

        // When the dropdown selection changes
        $('#orderby').change(function() {
            var selectedValue = $(this).val(); // Get the selected value
            var selectedLoad = '0'; // Set the initial load value
            loadPosts(selectedValue, selectedLoad); // Load posts based on the selected value
        });

        $('#loadmore').click(function() {
            var selectedLoad = '12'; // Updated to get a meaningful value
            var selectedValue = $('#orderby').val();
            loadPosts(selectedValue, selectedLoad); // Load posts based on the selected value
        });
    });
</script>