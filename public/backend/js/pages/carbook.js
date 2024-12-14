$(function () {
    $('#list-table').DataTable();
  })

function openEditModal(url, name, status) {
    // Set the form action URL
    document.getElementById('editForm').action = url;

    // Populate the input fields
    document.getElementById('editName').value = name;
    document.getElementById('estatus').value = status;

    // Open the modal
    $('#editModal').modal('show');
}
