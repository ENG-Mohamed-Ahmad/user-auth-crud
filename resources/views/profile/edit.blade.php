<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-4">
        <header class="mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </header>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 bg-white shadow rounded">
                    <h3>Update Profile Information</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white shadow rounded">
                    <h3>Update Password</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-4 bg-white shadow rounded">
                    <h3>Delete User</h3>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
