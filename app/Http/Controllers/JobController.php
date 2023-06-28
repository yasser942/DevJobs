<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Job $job , Request $request)
    {
        
        $searchQuery = request('search');
         $jobs = Job::latest()
        ->filter(request(['tag', 'search']))
        ->paginate(50);

       
        
        return view('job.index',compact('jobs','searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            $logoPath = Storage::putFile('public/images', $uploadedFile);
        }
        
        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'tags' => ['required','regex:/^[\w\s]+(?:,[\w\s]+)*$/',],
            'description'=>'required'
        ]);

        $formFields['user_id'] = auth()->id();
        $formFields['photo_path']=$logoPath;

       
        Job::create($formFields);

         return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request , $id)
    {

        $job =Job::find($id);
       
        
        
       
        return view('job.show',[
            'job' => $job
        ]);

       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $job =Job::find($id);
       
        
        return view('job.edit',[
            'job'=> $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $id,Request $request)
    {

         // Find the job by ID
         $job = Job::findOrFail($id);
         $logoPath = null;

         if ($request->hasFile('logo')) {
             $uploadedFile = $request->file('logo');
             $logoPath = Storage::putFile('public/images', $uploadedFile);
         }
        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'tags' => ['required','regex:/^[\w\s]+(?:,[\w\s]+)*$/',],
            'description'=>'required'
        ]);

       
         // Update the job attributes
        $formFields['photo_path']=$logoPath;
        $job->fill( $formFields);
        $job->save();
         return redirect('/jobs/manage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) 
    {
        $job = Job::findOrFail($id);
          $job->delete();
        return redirect('/jobs/manage');
    }

    public function manage (){
        $searchQuery = request('search');
        $userId = auth()->id();
         $jobs = Job::latest()->where('user_id', $userId)->filter(request([ 'search']))->paginate(10);


    return view("job.manage", compact('jobs','searchQuery'));
    }

    public function manageAll()
    {

        $searchQuery = request('search');
        // Retrieve all jobs
        $jobs = Job::latest()->filter(request([ 'search']))->paginate(50);
        

        // Pass the jobs data to the view
        return view('admin.manage_jobs', compact('jobs','searchQuery'));
    }

            public function deleteAll()
        {
            // Retrieve the authenticated user
                $user = auth()->user();
                
                // Retrieve all jobs belonging to the user
                $jobs = $user->jobs;
                
                // Delete each job
                foreach ($jobs as $job) {
                    $job->delete();
                }

            return redirect('/')->with('success', 'All jobs have been deleted.');
        }
        public function deleteAllJobs()
            {
                // Check if the authenticated user is an admin
                if (auth()->user()->role == 'admin') {
                    // Delete all jobs
                    Job::truncate();

                    return redirect('/')->with('success', 'All jobs have been deleted.');
                } else {
                    // If the user is not an admin, return an error or redirect to a different page
                }
            }
}
