$(function () {
    $('.select2').select2();

    $('#list-table').DataTable(
        {responsive: true}
    );

    // Function to allow only integers (whole numbers)
    $(".number").keypress(function(event) {
      if (
        (event.which < 48 || event.which > 57) &&
        event.which != 0 &&
        event.which != 8
      ) {
        event.preventDefault();
      }
    });

    // Function to handle paste event for integers (whole numbers)
    $(".number").bind("paste", function(e) {
      var text = e.originalEvent.clipboardData.getData("Text");
      if ($.isNumeric(text)) {
        $(this).val(text.replace(/[^0-9]/g, "")); // Remove non-numeric characters
      } else {
        e.preventDefault(); // Prevent pasting non-numeric text
      }
    });
})
