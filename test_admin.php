<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add New Admin</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Add New Admin</h1>
            <a href="" class="btn btn-primary">Back</a>
        </header>

        <!-- <form action="" method="post">
            <div class="form--element my-4">
                <input type="text" class="form-control" name="title" placeholder="Book Title:">
            </div>
            <div class="form--element my-4">
                <input type="text" class="form-control" name="author" placeholder="User Privilege:">
            </div>
            <div class="form--element my-4">
                <select name="type" class="form-control">
                    <option value="">Select Privilege Type</option>
                    <option value="User">User</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="form--element my-4">
                <input type="text" class="form-control" name="description" placeholder="Book Description:">
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="create" value="Add Book">
            </div>
        </form> -->

        <form action="process_admin.php" method="post">
            <div class="form--group my-4">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
            <div class="form--group my-4">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form--group my-4">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form--group my-4">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form--element my-4">
                <select name="user--type" class="form-control"> <!-- remove this user type -->
                    <option value="">Select Privilege Type</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="form--group">
                <input type="submit" class="btn btn-success" value="Add User" name="submit">
            </div>
        </form>
    </div>
</body>
</html>