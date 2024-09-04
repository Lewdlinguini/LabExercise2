<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Match the font from the layout */
            background-color: #1f2937; /* Dark background color */
            color: #e5e7eb; /* Light text color */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #111827; /* Darker background for the form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #e5e7eb; /* Light text color */
        }

        a {
            text-decoration: none;
            color: #3b82f6; /* Blue link color */
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #e5e7eb; /* Light text color */
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            padding: 10px;
            border: 1px solid #374151; /* Darker border color */
            border-radius: 4px;
            margin-bottom: 15px;
            width: 100%;
            background-color: #1f2937; /* Dark input background */
            color: #e5e7eb; /* Light text color */
        }

        button {
            padding: 10px 15px;
            background-color: #3b82f6; /* Blue button background */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: flex-end;
        }

        button:hover {
            background-color: #2563eb; /* Slightly darker blue on hover */
        }

        p {
            color: #dc2626; /* Red text color for error messages */
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .image-preview img {
            max-width: 150px;
            margin-top: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>

        <a href="{{ route('products.index') }}">Back to Product List</a>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
                <p>{{ $message }}</p>
            @enderror

            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}">
            @error('price')
                <p>{{ $message }}</p>
            @enderror

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <p>{{ $message }}</p>
            @enderror

            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            @error('image')
                <p>{{ $message }}</p>
            @enderror

            @if ($product->image)
                <div class="image-preview">
                    <img src="{{ Storage::url($product->image) }}" alt="Product Image">
                </div>
            @endif

            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>