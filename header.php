<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            padding: 15px;
        }
        .logo{
	width: 60px;
	height: 60px;
	background-image: url(images/logo.jpg);
	background-size: cover;
	background-position: center;
	object-fit: cover;
}
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
<div class="logo"></div>
    <a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="applications.php"><i class="fas fa-file-alt"></i> Applications</a>
    <a href="view_uploads.php"><i class="fas fa-folder-open"></i> View Uploads</a>
</div>