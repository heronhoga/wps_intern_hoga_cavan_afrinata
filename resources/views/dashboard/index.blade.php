<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>X Office - Home</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />

        <!--DATEPICKER-->
        <link
            href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
            rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <!--DATEPICKER-->

        <style>
            .table-responsive {
                margin: 0 auto;
                max-width: 80%;
            }

            .table {
                width: 100%;
                text-align: center;
            }

            #unauthorized {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
        </style>
    </head>
    <body>
        <!--NAVBAR HOME-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link">{{ $name.' - '.$role }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/home">Home</a>
                        </li>
                        @if($role === 'man-op' || $role === 'man-uang' || $role
                        === 'staf')
                        <li class="nav-item">
                            <a class="nav-link" href="/mylog">My Log</a>
                        </li>
                        @endif @if($role === 'direktur')
                        <li class="nav-item">
                            <a class="nav-link" href="/users"
                                >User Management</a
                            >
                        </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-danger" href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--NAVBAR HOME-->

        @if($role !== 'staf')
        <!--DATEPICKER AND RESET FORM-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <form
                        id="filterForm"
                        action="{{ route('filter.home') }}"
                        method="GET"
                        class="mt-3 d-inline-block"
                    >
                        @csrf
                        <div class="input-group" style="max-width: 300px">
                            <input
                                type="text"
                                id="datepicker"
                                name="selected_date"
                                class="form-control"
                                placeholder="Select Date"
                            />
                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>
                        </div>
                        <div class="mt-2">
                            <a
                                href="{{ route('home') }}"
                                type="button"
                                id="resetDate"
                                class="btn btn-secondary"
                                >Reset</a
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--DATEPICKER FORM-->

        <!--TABLE-->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Description</th>
                        <th scope="col">View Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->name }}</td>
                        <td>{{ $log->role }}</td>
                        <td>{{ $log->description }}</td>
                        <td>
                            @if ($log->photourl)
                            <a
                                href="{{ asset('storage/' . $log->photourl) }}"
                                target="_blank"
                                class="btn btn-primary"
                                >View Image</a
                            >
                            @else No Image @endif
                        </td>

                        <td>{{ $log->status }}</td>
                        <td>
                            {{ (new DateTime($log->created_at))->setTimezone(new DateTimeZone('Asia/Bangkok'))->format('Y-m-d H:i:s') }}
                        </td>
                        <td>
                            <form
                                action="{{ route('log.approve', $log->log_id) }}"
                                method="POST"
                                style="display: inline"
                            >
                                @csrf @method('put')
                                <button type="submit" class="btn btn-success">
                                    Terima
                                </button>
                            </form>
                            <form
                                action="{{ route('log.disapprove', $log->log_id) }}"
                                method="POST"
                                style="display: inline"
                            >
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-danger">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--TABLE-->

        @else
        <h1 id="unauthorized">
            Since you are a staff, you won't be able to monitor any log
        </h1>
        @endif

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                flatpickr("#datepicker", {
                    dateFormat: "Y-m-d",
                });
            });
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
