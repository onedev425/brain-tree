<div class="md:grid grid-cols-12 gap-2 w-full">
    <div class="col-span-12">
        <x-display-validation-errors />
        <p class="text-secondary text-center lg:text-left my-2">
            {{__('All fields marked * are required')}}
        </p>
    </div>
    <div x-data="showImage()" class="col-span-12">
        <img id="profile-picture" src="{{asset($user->profile_photo_url ??'application-images/user-profile-image.png')}}" alt="Profile Picture" class="w-64 h-64 rounded-full profile-image mx-auto block border border-black dark:border-white shadow" >
        <x-input type="file" id="profile-image-selector"  name="profile_photo" class="hidden" label="Select Profile image" label-class="border p-2 bg-blue-700 hover:bg-blue-800 active:bg-blue-900 w-72 text-center m-auto rounded text-white"   @change="showPreview(event)" accept="image/*" />
    </div>
    <x-input name="first_name" id="first-name" label="First name *" placeholder="{{$role}}'s first name" group-class="col-span-6" value="{{$user->firstName}}"/>
    <x-input name="last_name" id="last-name" label="Last name *" placeholder="{{$role}}'s last name" group-class="col-span-6" value="{{$user->lastName}}" />
    <x-input name="email" id="email" type="email" label="Email address *" placeholder="Enter {{$role}}'s email address" group-class="col-span-6" value="{{$user->email}}" />
    <x-input id="phone" name="phone" label="Phone number" placeholder="{{$role}}'s phone number" group-class="col-span-6"  value="{{$user->phone}}"/>
    <x-input type="date" id="birthday" name="birthday" placeholder="Choose {{$role}}'s birthday..." label="Birthday *" group-class="col-span-3  w-full"  value="{{$user->birthday}}"/>
    <x-input id="address" name="address" placeholder="{{$role}}'s address" group-class="col-span-9 no-resize" label="Address *"  value="{{$user->address}}"/>
    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("profile-picture");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
</div>

