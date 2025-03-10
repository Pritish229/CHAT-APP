<div>
    <label for="{{ $inputId }}">{{ $labelname }}</label>
    <div class="mb-3 w-full">
        <input type="file" class="form-control" id="{{ $inputId }}" name="{{ $name }}"
            onchange="updateLabelAndPreview('{{ $inputId }}', '{{ $previewId }}', '{{ $width }}', '{{ $height }}');"
            accept="image/*">
    </div>
    <div id="{{ $previewId }}">
        @if ($initialImageUrl)
            <img src="{{ $initialImageUrl }}" style="width: {{ $width }}; max-height: {{ $height }};">
        @endif
    </div>
</div>

<script>
    /**
     * Updates the preview dynamically with the specified width and height.
     */
    function updateLabelAndPreview(fileInputId, previewId, width, height) {
        const fileInput = document.getElementById(fileInputId);
        const imagePreview = document.getElementById(previewId);

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.width = width; // Set dynamic width
                img.style.maxHeight = height; // Set dynamic height
                imagePreview.innerHTML = ''; // Clear previous preview
                imagePreview.appendChild(img);
            };

            reader.readAsDataURL(file); // Read the file as Data URL
        } else {
            imagePreview.innerHTML = ''; // Clear the preview if no file is selected
        }
    }

    /**
     * Sets the initial values for the image preview dynamically.
     */
    function setInitialValues(previewId, initialImageUrl, width, height) {
        const imagePreview = document.getElementById(previewId);

        if (initialImageUrl) {
            const img = document.createElement('img');
            img.src = initialImageUrl;
            img.style.width = width; // Set dynamic width
            img.style.maxHeight = height; // Set dynamic height
            imagePreview.innerHTML = ''; // Clear previous preview
            imagePreview.appendChild(img);
        } else {
            imagePreview.innerHTML = ''; // Clear the preview if no URL is provided
        }
    }

    function resetImagePreview(fileInputId,previewId) {
        const fileInput = document.getElementById(fileInputId);
        fileInput.value = ''; // Reset the file input
        const imagePreview = document.getElementById(previewId);
        imagePreview.innerHTML = '';
    }

    
</script>
