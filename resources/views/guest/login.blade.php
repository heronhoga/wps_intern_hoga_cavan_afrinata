<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>X Office - Login</title>
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
                <h5 class="card-title">Login</h5>
                <form action="/login" method="POST">
                    @csrf @method('POST')
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

                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let message = "{{ session('message') }}";
            if (message === "successreg") {
                Swal.fire({
                    title: "Berhasil Register!",
                    text: "Data sudah masuk!",
                    icon: "success",
                });
            }
        </script>
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
