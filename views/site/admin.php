<?php
?>

<style>
    body {
       
        font-family: Arial, sans-serif;
        background-color:rgba(121, 118, 118, 0.83); /* grey(100) */
    }
    form {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input, textarea, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #007BFF;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    #image-preview {
        display: none;
        margin-top: 10px;
        max-width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<form action="/site/admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

    <label for="title">Title:</label>
    <input type="text" id="title" name="AdminForm[title]" required>
    <br>

    <label for="description">Description:</label>
    <textarea id="description" name="AdminForm[description]" required></textarea>
    <br>

    <label for="type">Type:</label>
    <select id="type" name="AdminForm[type]" required>
        <option value="upper">Upper</option>
        <option value="middle">Middle</option>
        <option value="lower">Lower</option>
    </select>
    <br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="AdminForm[date]" required>
    <br>

    <label for="location">Location:</label>
    <input type="text" id="location" name="AdminForm[location]" required>
    <br>

    <label for="image">Upload Image or Enter URL:</label>
    <input type="file" id="image-upload" name="AdminForm[imageFile]" accept="image/*" onchange="previewImage(event)">
    <input type="url" id="image-url" name="AdminForm[imageUrl]" placeholder="Enter image URL" oninput="previewImageFromUrl(event)">
    <img id="image-preview" alt="Image Preview">
    <br>

    <button type="submit">Submit</button>
</form>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }
</script>


