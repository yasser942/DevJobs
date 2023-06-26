@include('components.header')

        <main>
           
           
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                            class="w-48 mr-6 mb-6"
                            src="images/acme.png"
                            alt=""
                        />

                        <h3 class="text-2xl mb-2">{{$job->title}}</h3>
                        <div class="text-xl font-bold mb-4">{{$job->company}}</div>
                        <ul class="flex">
                              @for ($i = 0; $i < count($job['tags']); $i++)
                                    <li
                                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                                >
                                    <a href="/?tag={{$job['tags'][$i]}}">{{$job['tags'][$i]}}</a>
                                </li>
                                @endfor
                        </ul>
                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i>{{$job->location}}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                               
                                <p>
                                    {{$job->description}}
                                </p>

                                <a
                                    href="mailto:{{$job->email}}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="https://{{$job->website}}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >

                                @if(auth()->check() && $job->user_id === auth()->user()->id)
                                
                                <a href="{{ route('jobs.manage') }}" class="block bg-green-500 text-white py-2 rounded-xl hover:opacity-80">
                                    <i class="fa-solid fa-gear"></i> Manage Jobs
                                </a>
                                @endif
                               <div>
                               
                                
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('components.footer')
    </body>
</html>
