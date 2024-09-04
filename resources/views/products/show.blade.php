<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
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

        .product-details {
            display: flex;
            flex-direction: column;
            color: #e5e7eb; /* Light text color */
        }

        .product-details img {
            max-width: 150px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .product-details label {
            font-weight: bold;
            color: #e5e7eb; /* Light text color */
            margin-top: 10px;
        }

        .product-details p {
            margin: 0;
            color: #e5e7eb; /* Light text color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $product->product_name }}</h1>

        <a href="{{ route('products.index') }}">Back to Product List</a>

        <div class="product-details">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="Product Image">
            @endif

            <label>Description:</label>
            <p>{{ $product->description }}</p>

            <label>Price:</label>
            <p>${{ number_format($product->price, 2) }}</p>

            <label>Stock:</label>
            <p>{{ $product->stock }}</p>
        </div>
    </div>
</body>
</html>