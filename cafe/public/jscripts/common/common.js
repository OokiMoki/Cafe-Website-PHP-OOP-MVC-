// $("#logout-btn").click(function(){
//     window.location.href = "../../core/logout_process.php"
// })

$(document).ready(function () {
    $(document).on("click", ".delete", function () {
        $("#deleteModal").modal("show");
        var id = $(this).data("id")
        var url = $(this).data("url")

        $("#delete-form").attr("action", url);
        $("#delete-form #id").val(id);
    })
});

function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('imagePreview');

    var reader = new FileReader();
    reader.onload = function() {
        preview.src = reader.result;
        preview.style.display = "block"
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}