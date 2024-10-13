$(document).ready(function () {
    $("#wishlist-link").on("click", function (e) {
        e.preventDefault();
        $("#wishlist-form").submit();
    });

    $(".qty-control__reduce_cart").on("click", function () {
        $(this).closest("form").submit();
    });
    $(".qty-control__increase_cart").on("click", function () {
        $(this).closest("form").submit();
    });

    $(".remove-cart").on("click", function () {
        $(this).closest("form").submit();
    });

    $("#orderby").on("change", function () {
        $("#order").val($("#orderby option:selected").val());
        $("#frmFilter").submit();
    });

    $("input[name='brands']").on("change", function () {
        var brands = "";
        $("input[name='brands']:checked").each(function () {
            if (brands == "") {
                brands += $(this).val();
            } else {
                brands += "," + $(this).val();
            }
        });
        $("#brands").val(brands);
        $("#frmFilter").submit();
    });

    $("input[name='categories']").on("change", function () {
        var categories = "";
        $("input[name='categories']:checked").each(function () {
            if (categories == "") {
                categories += $(this).val();
            } else {
                categories += "," + $(this).val();
            }
        });
        $("#categories").val(categories);
        $("#frmFilter").submit();
    });

    $("[name='price_range']").on("change", function () {
        const [minValue, maxValue] = $(this).val().split(",");
        $("#min").val(minValue);
        $("#max").val(maxValue);

        clearTimeout($.data(this, "timer"));

        const timer = setTimeout(() => {
            $("#frmFilter").submit();
        }, 2000);

        $(this).data("timer", timer);
    });

    $(".swatch-size").on("click", function (e) {
        e.preventDefault();

        let selectedSize = $(this).data("size-id");

        if (selectedSize > 0) {
            $("#sizes").val(selectedSize);
        }

        let isActive = $(this).hasClass("active");

        $(".swatch-size").removeClass("active");
        if (!isActive) {
            $(this).addClass("active");
        }

        let activeSizes = $(".swatch-size.active")
            .map(function () {
                return $(this).data("size-id");
            })
            .get();

        $("#sizes").val(activeSizes.join(","));

        $("#frmFilter").submit();
    });

    $(".swatch-color").on("click", function (e) {
        e.preventDefault();

        let selectedColor = $(this).data("color-id");
        let colorCode = $(this).css("color");
        let isActive = $(this).hasClass("active");

        if (isActive) {
            $(this).removeClass("active").css("border-color", "transparent");
            $("#colors").val("");
            $("#selectedColor").val("");
        } else {
            $(".swatch-color")
                .removeClass("active")
                .css("border-color", "transparent");
            $(this).addClass("active").css("border-color", colorCode);
            $("#colors").val(selectedColor);
            $("#selectedColor").val(selectedColor);
        }

        $("#frmFilter").submit();
    });

    $(".remove-wishlist").on("click", function () {
        $(this).closest("form").submit();
    });

    $("#new_password_confirmation").keyup(function () {
        let Pass = $("#new_password").val();
        let conPass = $("#new_password_confirmation").val();

        if (Pass != conPass) {
            $("#confirm_password").html("Password not matching");
            $("#confirm_password").css("color", "red");
            return false;
        } else {
            $("#confirm_password").html("Password matched");
            $("#confirm_password").css("color", "green");
            return false;
        }
    });
});

$(document).ready(function () {
    let storedColor = $("#selectedColor").val();
    if (storedColor) {
        let activeElement = $(
            ".swatch-color[data-color-id='" + storedColor + "']"
        );
        let colorCode = activeElement.css("color");
        activeElement.addClass("active").css("border-color", colorCode);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".pc__atc");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const productName = this.getAttribute("data-name");
            const productPrice = this.getAttribute("data-price");
            const productSizes = JSON.parse(this.getAttribute("data-sizes")); // Parse JSON for sizes
            const productColors = JSON.parse(this.getAttribute("data-colors")); // Parse JSON for colors

            // Set the values in the modal
            document
                .getElementById("addToCartForm")
                .querySelector('input[name="id"]').value = productId;
            document
                .getElementById("addToCartForm")
                .querySelector('input[name="name"]').value = productName;
            document
                .getElementById("addToCartForm")
                .querySelector('input[name="price"]').value = productPrice;

            // Populate size select
            const sizeSelect = document.getElementById("sizeSelect");
            sizeSelect.innerHTML = '<option value="">Select Size</option>'; // Reset options
            productSizes.forEach((size) => {
                sizeSelect.innerHTML += `<option value="${size.id}">${size.name}</option>`;
            });

            // Populate color select
            const colorSelect = document.getElementById("colorSelect");
            colorSelect.innerHTML = '<option value="">Select Color</option>'; // Reset options
            productColors.forEach((color) => {
                colorSelect.innerHTML += `<option value="${color.id}">${color.name}</option>`;
            });
        });
    });
});

document.querySelectorAll(".star-rating__star-icon").forEach(function (star) {
    star.addEventListener("click", function () {
        const rating = this.getAttribute("data-value");
        document.getElementById("form-input-rating").value = rating;

        // Update the star colors
        document
            .querySelectorAll(".star-rating__star-icon")
            .forEach(function (s) {
                s.setAttribute("fill", "#ccc");
            });
        this.setAttribute("fill", "#FFD700");
    });
});

document.querySelector(".to-share").addEventListener("click", function () {
    const shareButtons = document.querySelector(".social-share-buttons");
    shareButtons.hidden = !shareButtons.hidden; // Toggle visibility
});

document.addEventListener("DOMContentLoaded", function () {
    const sizeSelect = document.getElementById("sizeSelect");
    const colorSelect = document.getElementById("colorSelect");
    const sizeIdInput = document.getElementById("sizeIdInput");
    const colorIdInput = document.getElementById("colorIdInput");

    sizeSelect.addEventListener("change", function () {
        sizeIdInput.value = this.value;
    });

    colorSelect.addEventListener("change", function () {
        colorIdInput.value = this.value;
    });
});
