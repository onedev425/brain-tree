<div class="card">
   <div class="card-body">
       <h3 class="text text-2xl m-2 font-bold">Student Info</h3>
       <div class="flex mt-5">
           <img width="150" height="150" class="rounded-full" src="{{ $user->profile_photo_path }}" onerror="this.src='{{ asset('images/logo/avatar.png') }}'" />
           <div class="flex items-start flex-col flex-wrap justify-center ml-8">
               <div class="text-xl">{{ $user->name }}</div>
               <div>Joined in {{ date('jS F Y', strtotime($user->created_at)) }}</div>
           </div>
       </div>
   </div>
</div>
