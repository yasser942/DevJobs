<footer
class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
>
<p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>

@auth
<a
href="{{route('jobs.create')}}"
class="absolute top-1/3 right-10 bg-red-500 text-white py-2 px-5"
>Post Job</a
>
@endauth
</footer>