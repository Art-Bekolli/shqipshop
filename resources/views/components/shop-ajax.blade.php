<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('input[name="category[]"]').change(function() {
        if ($(this).is(":checked")) {
            $(this).parent().addClass("active");
        } else {
            $(this).parent().removeClass("active");
        }
    });


    jQuery(document).ready(function($) {
        // Load products initially, considering the URL parameter for search
        var initialSearchTerm = getUrlParameter('r'); // Get the search term from the URL
        var initialSearchCat = getUrlParameter('c'); // Get the search term from the URL
        loadMythemeProducts(1, [], 'default', 'default', initialSearchTerm, initialSearchCat);

        // Event listener for category checkboxes
        $('#category-filter input[type="checkbox"]').on('change', function() {
            if (initialSearchCat == '') {
                filterProducts();
            } else {
                window.location.replace("/wordpress/shop");
            }

        });

        // Event listener for sorting dropdowns
        $('#sort-by, #price-sort').on('change', function() {
            filterProducts();
        });

        // Event listener for pagination
        $('body').on('click', '.pagination-link', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            filterProducts(page);
        });

        function filterProducts(page = 1) {
            var selectedCategories = [];
            $('#category-filter input[type="checkbox"]:checked').each(function() {
                selectedCategories.push($(this).val());
            });

            var sortBy = $('#sort-by').val();
            var priceSort = $('#price-sort').val();
            var searchTerm = getUrlParameter('r'); // Re-fetch the search term from the URL
            var searchCat = getUrlParameter('c');

            loadMythemeProducts(page, selectedCategories, sortBy, priceSort, searchTerm, searchCat);
        }

        function loadMythemeProducts(page, categories, sortBy, priceSort, searchTerm, searchCat = '') {
            $.ajax({
                url: '<?php echo admin_url("admin-ajax.php"); ?>'
                , type: 'POST'
                , data: {
                    action: 'mytheme_filter_products'
                    , page: page
                    , categories: categories
                    , sort_by: sortBy
                    , price_sort: priceSort
                    , search_term: searchTerm, // Include the search term
                    search_cat: searchCat
                }
                , beforeSend: function() {
                    $('#products-container').html('<div id="loading"><p>Loading products...</p></div>');
                }
                , success: function(response) {
                    $('#products-container').html(response.products);
                    $('#pagination-container').html(response.pagination);
                }
            });
        }

        // Function to get URL parameters
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }
    });

</script>
