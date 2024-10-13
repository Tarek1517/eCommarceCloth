$(document).ready(function() {
    $("#search-input").on("keyup", function() {
        var searchQuery = $(this).val();

        if (searchQuery.length > 3) {
            $.ajax({
                type: "GET",
                url: "{{ route('customer.search') }}",
                data: {
                    query: searchQuery
                },
                dataType: "json",
                success: function(data) {
                    $("#box-content-search").html(""); 

                    $.each(data, function(index, item) {
                        var link = "/shop/product/" + item
                        .slug; 
                        var imageUrl = item.galleryImages.length > 0 ? item
                            .galleryImages[0] :
                            '/storage/img/default.jpg'; 

                       
                        $("#box-content-search").append(`
                    <li>
                        <ul>
                            <li class="product-item gap14 mb-10">
                                <div class="image no-bg">
                                    <img src="${imageUrl}" alt="${item.name}" class="image">
                                </div>
                                <div class="Flex items-center justify-between gap20 flex-grow">
                                    <div class="name">
                                        <a href="${link}" class="body-title-2">${item.name}</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                `);
                    });
                }
            });
        } else {
           
            $("#box-content-search").html("");
        }
    });
});