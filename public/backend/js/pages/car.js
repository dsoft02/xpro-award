$(function () {
    $('#list-table').DataTable();

    CKEDITOR.replace('description');

    $('#carBrand').on('select2:select', function () {
        const brandId = $(this).val();
        const carModel = $('#carModel');

        carModel.html('<option value="">Select a Model</option>');

        // Check if a brand is selected
        if (brandId) {
            // Fetch models based on the selected brand ID
            fetch(`/admin/cars/get-models/${brandId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(models => {
                    // Populate the model dropdown
                    $.each(models, function (id, name) {
                        const option = new Option(name, id, false, false);
                        carModel.append(option);
                    });

                    // Refresh the Select2 dropdown
                    carModel.trigger('change');
                })
                .catch(error => console.error('Error fetching models:', error));
        }
    });

  });

let removedImages = [];

function previewImages(event) {
    const imageUploadContainer = document.getElementById('image-upload-container');
    const files = event.target.files;
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'image-preview';
            div.innerHTML = `
                <img src="${e.target.result}" alt="Car Image">
                <button type="button" class="remove-btn" onclick="removeImage(${i})">&times;</button>
            `;
            div.dataset.index = i;
            imageUploadContainer.insertBefore(div, imageUploadContainer.firstChild);
        };
        reader.readAsDataURL(file);
    }
}

function removeImage(index) {
    const imageContainer = document.querySelector(`.image-preview[data-index='${index}']`);
    if (imageContainer) {
        imageContainer.remove();
    }
    // Update the input files
    const filesInput = document.getElementById('images');
    const dataTransfer = new DataTransfer();
    Array.from(filesInput.files)
        .filter((_, i) => i !== index)
        .forEach(file => dataTransfer.items.add(file));
    filesInput.files = dataTransfer.files;
}

function removeExistingImage(index) {
    removedImages.push(index);
    const imageContainer = document.querySelector(`.image-preview[data-index='${index}']`);
    if (imageContainer) {
        imageContainer.remove();
    }
    // Add the removed images to a hidden input field for backend processing
    const removedInput = document.createElement('input');
    removedInput.type = 'hidden';
    removedInput.name = 'removed_images[]';
    removedInput.value = index;
    document.querySelector('form').appendChild(removedInput);
}
