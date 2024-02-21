<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>X Office - Create Log</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" id="dateTitle">
                                Upload Daily Log:
                            </h5>
                            <p class="card-text">
                                Please fill out the form below to upload your
                                photo.
                            </p>
                            <form
                                method="POST"
                                action="{{ route('log.store') }}"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <div class="mb-3">
                                    <label for="description" class="form-label"
                                        >Description</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="description"
                                        name="description"
                                    />
                                </div>
                                <div class="mb-3">
                                    <label
                                        for="exampleInputFile"
                                        class="form-label"
                                        >Choose Photo</label
                                    >
                                    <input
                                        type="file"
                                        class="form-control"
                                        id="photo"
                                        name="photo"
                                    />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const today = new Date();

            const utcPlus7Date = new Date(today.getTime() + 7 * 60 * 60 * 1000);

            const options = { year: "numeric", month: "long", day: "numeric" };
            const formattedDate = utcPlus7Date.toLocaleDateString(
                "en-US",
                options
            );

            document.getElementById("dateTitle").textContent += formattedDate;
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
