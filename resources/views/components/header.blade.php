<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{ asset('storage/images/dev.png') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#15385b",
                        },
                    },
                },
            };
        </script>
        <title>DevJobs | Find  Jobs & Projects</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="/">
                <img src="{{ asset('storage/images/homePage.png') }}" alt="Logo" class="logo" style="width: 40px;">
            </a>
            <ul class="flex space-x-6 mr-6 text-lg">
               
                @auth

                <li>
                    <a href="{{route('jobs.manage')}}" class="hover:text-laravel"
                        ><i class="fa-solid fa-gear"></i> Manage Jobs</a
                    >
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                       
                        <button class="text-black-600 hover:text-laravel">
                            <i
                                class="fa-solid fa-door-closed hover:text-laravel"
                            ></i>
                            Logout
                        </button>
                    </form>
                    
                </li>
                

                @else
                <li>
                    <a href="{{route('register')}}" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </li>
                <li>
                    <a href="{{ route('login') }}" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </li>
                @endauth
                
               
            </ul>
        </nav>