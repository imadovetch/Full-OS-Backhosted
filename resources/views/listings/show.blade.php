<x-layout>
    <a href="{{ url()->previous() }}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
      <x-card class="p-10">
        <div class="flex flex-col items-center justify-center text-center">
          <img class="w-48 mr-6 mb-6"
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />
  
          <h3 class="text-2xl mb-2">
            {{$listing->title}}
          </h3>
          <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
  
          <x-listing-tags :tagsCsv="$listing->tags" />
  
          <div class="text-lg my-4">
            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
          </div>
          <form method="POST" action="{{ route('status.store', ['listing_id' => $listing->id]) }}" class="mb-6">
            @csrf
            <label for="toggle">if applied, check & submit</label>
            <input type="checkbox" id="toggle" name="applied" value="yes">
            <button type="submit" class="bg-laravel text-white rounded py-1 px-4 hover:bg-black">
              Submit</button>
        </form>

        
          <div class="border border-gray-200 w-full mb-6"></div>
          <div>
            <h3 class="text-3xl font-bold mb-4">Job Description</h3>
            <div class="text-lg space-y-6">
              {{$listing->description}}
  
              <a href="https://mail.google.com/mail/?view=cm&amp;to={{$listing->email}}" target="_blank" rel="noopener noreferrer"
                class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                  class="fa-solid fa-envelope"></i>
                Contact Employer</a>

  
                <a href="https://{{$listing->website}}" target="_blank" rel="noopener noreferrer"
                  class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-globe"></i>
                  Visit Website</a>
            </div>
          </div>
        </div>
      </x-card>
    </div>

   
  
  </x-layout>