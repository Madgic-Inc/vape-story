@extends('adminlte::page')

@section('content')
    @vite(['resources/js/app.js'])
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .custom-file-input {
            cursor: pointer;
        }

        .custom-file-label {
            left: 0;
            right: 0;
            z-index: 2;
        }

        .img-preview {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Form</h1>

        <form method="POST" action="/create-product" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control-file" id="image" name="image" custom>
                <label class="custom-file-label" for="image">Choose File</label>
                <img class="img-preview" src="#" alt="Image Preview">
            </div>

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description"></textarea>
            </div>

            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" class="form-control" id="stock" name="stock" min="1" placeholder="Enter stock quantity">
            </div>

            <div class="form-group">
                <label for="value">Product Value</label>
                <input type="number" class="form-control" id="value" name="value" step="0.01" placeholder="Enter product value">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.querySelector('.img-preview');

        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>
</html>

@endsection
