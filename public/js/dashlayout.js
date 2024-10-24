$(document).ready(function () {
    $("#name").keyup(function () {
        var value = $(this).val();
        $("#slug").val(value);

        let formattedVal = value.replace(/\s+/g, "_").toLowerCase();
        $("#slug").val(formattedVal);
    });

    $(function () {
        $("#myFile").on("change", function (e) {
            const photoInp = $("#myFile");
            const [file] = this.files;
            if (file) {
                $("#imgpreview img").attr("src", URL.createObjectURL(file));
                $("#imgpreview").show();
            }
        });

        $("#gFile").on("change", function (e) {
            $(".gitems").remove();
            const gFile = $("gFile");
            const gphotos = this.files;
            $.each(gphotos, function (key, val) {
                $("#galUpload").prepend(
                    `<div class="item gitems"><img src="${URL.createObjectURL(
                        val
                    )}" alt=""></div>`
                );
            });
        });
    });

    $(".js-example-basic-multiple").select2();

    $("#btn-Features").on("click", function () {
        var fieldIndex = new Date().getTime(); // Use a unique timestamp for unique IDs
        var inputDiv = `
    
            <span class="Feature-container">
    
                <div class="remove-btn">
                    <button type="button" class="btn btn-danger mb-5 "><i class="fa-solid fa-xmark"></i></button>
                </div>
    
                <div class="row mb-3 mt-5">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="body-title1" for="stitle">Sidebar Title <span class="tf-color-1">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <input class="flex-grow" type="text" placeholder="Sidebar Title" name="stitle[]" required>
                    </div>
                </div>

                <!-- Sidebar Description -->
                <div class="row mb-3 mt-5">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="body-title1" for="sdescription">Sidebar Description <span class="tf-color-1">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <textarea class="mb-10" name="sdescription[]" placeholder="Sidebar Description" required></textarea>
                    </div>
                </div>

                <!-- Upload Sidebar Images -->
                <div class="row mb-3 mt-5">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="body-title1" >Upload Sidebar Images <span class="tf-color-1">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <div class="upload-image">
                            <div class="item" id="imgpreview_${fieldIndex}" style="display:none">
                                <img src="" class="effect8" alt="Preview Image">
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myFiles_${fieldIndex}">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="body-text">Drop your images here or <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFiles_${fieldIndex}" name="simage[]">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Select Side -->
                <div class="row mb-3 mt-5">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="body-title1" for="side">Select Side</label>
                    </div>
                    <div class="col-md-10">
                        <select class="mb-10" name="side[]">
                            <option value="right">Right</option>
                            <option value="left">Left</option>
                        </select>
                    </div>
                </div>
    
            </span>
        `;

        // Append the new input fieldset
        $("#moreFeatures").append(inputDiv);
    });

    $("#moreFeatures").on("click", ".remove-btn", function () {
        $(this).closest(".Feature-container").remove(); // Remove the entire feature container
    });

    // Event delegation for dynamically added file inputs
    $("#moreFeatures").on("change", "input[type='file']", function (e) {
        var fieldIndex = $(this).attr("id").split("_")[1]; // Extract field index from ID
        const [file] = this.files;
        if (file) {
            $(`#imgpreview_${fieldIndex} img`).attr(
                "src",
                URL.createObjectURL(file)
            );
            $(`#imgpreview_${fieldIndex}`).show();
        }
    });

    $(function () {
        $("#myImg").on("change", function (e) {
            const photoInp = $("#myImg");
            const [file] = this.files;
            if (file) {
                $("#imgprev img").attr("src", URL.createObjectURL(file));
                $("#imgprev").show();
            }
        });
    });

    $(".btn-modal").on("click", function () {
        let aboutsidebar = $(this).attr("data-aboutsidebar");
        let sidebar = JSON.parse(aboutsidebar);
        let tableBody = $(".show-modal-data");

        // Get the base URL for images from the button's data attribute
        let baseUrl = $(this).attr("data-baseurl");

        // Clear previous data
        tableBody.empty();

        if (!tableBody) return;

        // Make modal content data
        sidebar.forEach(function (item, idx) {
            let tableRow = "<tr>";
            tableRow += "<td class='align-middle'>" + (idx + 1) + "</td>";
            tableRow += "<td class='align-middle'>" + item.stitle + "</td>";
            tableRow +=
                "<td class='align-middle'>" + item.sdescription + "</td>";

            // Check if the image value is null or empty
            if (item.simage) {
                // If there's an image, construct the full image URL
                let imageUrl = baseUrl + "/" + item.simage;
                tableRow +=
                    "<td class='align-middle'><img src='" +
                    imageUrl +
                    "' alt='Image' width='100' /></td>";
            } else {
                // If no image, display the word "null"
                tableRow += "<td class='align-middle'>null</td>";
            }

            tableRow += "<td class='align-middle'>" + item.side + "</td>";
            tableRow += "</tr>";

            // Append table row here
            tableBody.append(tableRow);
        });
    });

    $(function () {
        $(".myImg").on("change", function () {
            const input = this;
            const [file] = input.files;
            if (file) {
                // Find the closest image preview container within the same form fieldset
                $(input)
                    .closest(".upload-image")
                    .find("img")
                    .attr("src", URL.createObjectURL(file))
                    .show();
            }
        });
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

    $("#new_password_confirmation_model").keyup(function () {
        let Pass = $("#old_password").val();
        let conPass = $("#new_password_confirmation_model").val();

        if (Pass != conPass) {
            $("#confirm_password_model").html("Password not matching");
            $("#confirm_password_model").css("color", "red");
            return false;
        } else {
            $("#confirm_password_model").html("Password matched");
            $("#confirm_password_model").css("color", "green");
            return false;
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var quill = new Quill("#editor", {
        theme: "snow",
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["code-block"],
                ["clean"],
            ],
        },
    });

    if (typeof description !== "undefined" && description) {
        quill.root.innerHTML = description;
    }

    var form = document.querySelector("#career-form");
    form.onsubmit = function () {
        var descriptionTextarea = document.querySelector(
            "textarea[name=description]"
        );
        descriptionTextarea.value = quill.root.innerHTML;
    };
});

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".open-delete-modal");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const adminId = this.getAttribute("data-id");
            const form = document.getElementById("deleteAdminForm");
            form.setAttribute("action", `/admin/delete/${adminId}`);
        });
    });

    const form = document.getElementById("deleteAdminForm");
    form.addEventListener("submit", function (e) {
        const password = document.getElementById("old_password").value;
        const confirmPassword = document.getElementById(
            "new_password_confirmation"
        ).value;
        const errorElement = document.getElementById("confirm_password_error");

        if (password !== confirmPassword) {
            e.preventDefault();
            errorElement.style.display = "block";
        } else {
            errorElement.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetchNotifications();
});

function fetchNotifications() {
    fetch("/get-notifications")
        .then((response) => response.json())
        .then((data) => {
            document.getElementById("notificationCount").innerText =
                data.newOrdersCount + data.newMessagesCount;
            document.getElementById("orderCount").innerText =
                data.newOrdersCount;
            document.getElementById("messageCount").innerText =
                data.newMessagesCount;
        });
}

$(document).ready(function() {
    // Select All functionality
    $("#select_all_ids").click(function() {
        $(".checkbox_ids").prop("checked", $(this).prop("checked"));
    });

    // If any checkbox is unchecked, uncheck the "Select All" checkbox
    $(".checkbox_ids").click(function() {
        if (!$(this).prop("checked")) {
            $("#select_all_ids").prop("checked", false);
        }
    });

    // Trigger form submission when the delete button is clicked
    $("#deleteAllselecteds").click(function() {
        if ($("input[name='ids[]']:checked").length > 0) {
            if (confirm('Are you sure you want to delete the selected orders?')) {
                $("#deleteOrdersForm").submit(); // Submit the form
            }
        } else {
            alert('No orders selected');
        }
    });
});




