document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('upload-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
            document.querySelector('.upload-label').style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});