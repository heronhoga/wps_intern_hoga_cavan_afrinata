<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>X Office - Register</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{ asset('css/register-guest.css') }}" />
    </head>
    <body
        class="d-flex align-items-center justify-content-center"
        style="
            min-height: 100vh;
            background-image: url(images/registerimage.jpg);
            background-size: cover;
        "
    >
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
                <form action="/register" method="POST">
                    @csrf @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            name="name"
                            type="text"
                            class="form-control"
                            id="name"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"
                            >Email address</label
                        >
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"
                            >Password</label
                        >
                        <input
                            name="password"
                            type="password"
                            class="form-control"
                            id="password"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="select" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            <option value="direktur">Direktur</option>
                            <option value="man-op">Manager Operasional</option>
                            <option value="man-uang">Manager Keuangan</option>
                            <option value="staf">Staf</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
