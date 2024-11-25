<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Tutorial Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: #343a40;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .language-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .language-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">CodeMaster</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a href="{{ route('home', ['id' => $language->id])}}" class="nav-link">{{ $language->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if(!Auth::check())
                <a href="{{ route('login')}}" class="btn btn-primary">Login As Admin</a>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4">Welcome to CodeMaster</h1>
            <p class="lead">Your one-stop platform to learn programming languages with ease.</p>
            <a href="#languages-section" class="btn btn-primary btn-lg">Explore Languages</a>
        </div>
    </section>

    <!-- Language Cards Section -->
    <section id="languages-section" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Programming Languages</h2>
                <p class="text-muted">Choose from a variety of programming languages and start your learning journey.
                </p>
            </div>
            <div class="row">
                @foreach ($languages as $language)
                    <div class="col-md-4 mb-4">
                        <div class="card language-card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $language->name }}</h5>
                                <p class="card-text">Explore tutorials, examples, and resources for {{ $language->name }}.
                                </p>
                                <a href="{{ route('home', ['id' => $language->id])}}" class="btn btn-outline-primary">Learn
                                    {{ $language->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 CodeMaster. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>