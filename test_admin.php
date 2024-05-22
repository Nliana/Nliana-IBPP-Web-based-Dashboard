<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add New User</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Add New User</h1>
            <a href="list_user.php" class="btn btn-primary">Back</a>
        </header>

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
                <select name="user--type" class="form-control"> 
                    <option value="">Select Privilege Type</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="form--group">
                <input type="submit" class="btn btn-success" value="Add User" name="create">
            </div>
        </form>
    </div>
</body>
</html>