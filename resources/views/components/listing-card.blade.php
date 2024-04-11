@props(['listing'])


<x-card>
 
  <div class="flex">
    <img class="hidden w-48 mr-6 md:block"
      src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}" alt="" />
    <div>
      <h3 class="text-2xl">
        @auth
        <h3 class="text-2xl">
          <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
        </h3>
        @else
        <h3 class="text-2xl">
          <a href="{{ route('login') }}">{{$listing->title}}</a>
        </h3>
        @endauth
      </h3>
      <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
      <x-listing-tags :tagsCsv="$listing->tags" />
      <div class="text-lg mt-4">
        <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
        @auth
        @php
        $userStatus = $listing->status
            ->where('user_id', auth()->id())
            ->where('listing_id', $listing->id)
            ->last();
        @endphp
    
        @if ($userStatus)
             <p class="text-sm text-[#666699] font-bold">You applied for this role on: {{ formatLocalizedWithSuffix(optional($userStatus->applied_on)->toDateString()) }}</p>

          @else
          <p class="text-sm text-[#666699] font-bold">You are yet to apply fo this role</p>
        @endif
        @endauth


      </div>
    </div>
  </div>
</x-card>