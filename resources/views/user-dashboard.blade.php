<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        .header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 20px;
        }

        /* Layout: sidebar + content */
        .container {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 150px;
            background-color: #dee2e6;
            padding: 20px;
            height: calc(100vh - 70px); /* Full height minus header */
        }

        .sidebar button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            background-color: #6c757d;
            color: white;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #495057;
        }

        /* Main content area */
        .content {
            flex: 1;
            padding: 30px;
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        /* Each section (Rescuing / Adoption) */
        .section {
            width: 45%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .section h3 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section ul {
            list-style-type: none;
            padding-left: 0;
        }

        .section ul li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>

    <!-- Header with user email -->
    <div class="header">
        Welcome, {{ session('user_email') ?? 'User' }}
    </div>

    <div class="container">
        <!-- Sidebar -->
    <div class="sidebar">
        <button onclick="window.location.href='{{ route('rescue.form') }}'">Rescuing</button>
        <button onclick="window.location.href='{{ route('adoption') }}'">Adoption</button>
        <button onclick="window.location.href='{{ route('logout') }}'" style="margin-top: 20px;">Logout</button>
    </div>


        <!-- Main content -->
        <div class="content">
            <!-- Rescuing Section -->
            <div class="section">
                <h3>About Rescuing</h3>
                <ul>
                    <li>Injured puppy rescued near park</li>
                    <li>Cat trapped on rooftop</li>
                    <li>Stray dog found in alley</li>
                    <li>Bird with broken wing</li>
                    <li>Dog abandoned near shelter</li>
                </ul>
            </div>

            <!-- Adoption Section -->
            <div class="section">
                <h3>About Adoption</h3>
                <ul>
                    <li>Luna the cat adopted</li>
                    <li>2 puppies rehomed</li>
                    <li>Rabbit available for adoption</li>
                    <li>Senior dog looking for home</li>
                    <li>New kittens up for adoption</li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>
