<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Match the font from the layout */
            background-color: #1f2937; /* Dark background color */
            color: #e5e7eb; /* Light text color */
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #111827; /* Darker background for content */
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #111827; /* Dark background color */
            border-bottom: 1px solid #374151; /* Darker border color */
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #e5e7eb; /* Light text color */
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile .name {
            font-size: 16px;
            color: #e5e7eb;
            margin-right: 10px; /* Space between name and dropdown */
        }

        .dropdown {
            position: relative;
        }

        .dropdown button {
            background-color: #3b82f6; /* Blue button background */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dropdown button:hover {
            background-color: #2563eb;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #111827; /* Dark background color */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 200px;
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #e5e7eb; /* Light text color */
        }

        .dropdown-menu a:hover {
            background-color: #374151; /* Darker background for hover effect */
        }

        .dropdown-menu.show {
            display: block;
            opacity: 1;
            visibility: visible;
        }

        .success-message {
            background-color: #10b981; /* Green background */
            color: #ffffff; /* White text color */
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #3b82f6; /* Blue link color */
        }

        a:hover {
            text-decoration: underline;
        }

        .create-button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-align: center;
        }

        .create-button:hover {
            background-color: #2563eb;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #374151; /* Dark border color */
            border-radius: 4px;
            margin-right: 10px;
            background-color: #1f2937; /* Dark input background */
            color: #e5e7eb; /* Light text color */
        }

        button {
            padding: 8px 12px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2563eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #374151; /* Darker border color */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3b82f6; /* Blue background for table headers */
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #111827; /* Darker background for even rows */
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions form {
            display: inline-block;
        }

        .actions a, .actions button {
            padding: 6px 12px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .actions a {
            background-color: #10b981; /* Green button background */
            color: white;
        }

        .actions a:hover {
            background-color: #059669;
        }

        .actions button {
            background-color: #dc2626; /* Red button background */
            color: white;
        }

        .actions button:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Product List</h1>
        <div class="profile">
            <div class="name">{{ Auth::user()->name }}</div>
            <div class="dropdown">
                <button onclick="toggleDropdown()">▼</button>
                <div id="dropdown-menu" class="dropdown-menu">
                    <a href="{{ route('profile.edit') }}">Profile</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="create-button">Create New Product</a>

        <form method="GET" action="{{ route('products.index') }}">
            <input type="text" name="search" placeholder="Search products" value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="actions">
                            <a href="{{ route('products.show', $product) }}">View</a>
                            <a href="{{ route('products.edit', $product) }}">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function toggleDropdown() {
            var menu = document.getElementById('dropdown-menu');
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            } else {
                menu.classList.add('show');
            }
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            var dropdownMenu = document.getElementById('dropdown-menu');
            if (!event.target.matches('.dropdown button')) {
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                }
            }
        }
    </script>
</body>
</html>