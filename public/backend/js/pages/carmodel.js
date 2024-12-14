$(function () {
    $('#list-table').DataTable();

    $('#brandSelect').select2({
        dropdownParent: $('#addModal')
    });

    $('#editBrand').select2({
        dropdownParent: $('#editModal')
    });

  })

function openEditModal(url, name, brand, status) {
    // Set the form action URL
    document.getElementById('editForm').action = url;

    // Populate the input fields
    document.getElementById('editName').value = name;
    $('#editBrand').val(brand).trigger('change');
    document.getElementById('estatus').value = status;

    // Open the modal
    $('#editModal').modal('show');
}
