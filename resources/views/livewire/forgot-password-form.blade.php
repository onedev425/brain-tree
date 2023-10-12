<div class="max-w-full w-full flex items-center justify-center px-5">
    <div class="text-gray-500 rounded-3xl w-full overflow-hidden">
        <div class="md:flex w-full py">
            <div class="w-full md:w-full px-4 sm:px-8 md:px-16 pt-3 pb-10">
                <div class="flex flex-cols justify-center items-center">
                    <a href="#"><img src="{{asset(config('app.logo'))}}" alt="" class="my-4"></a>
                </div>
                <form id="main_form" action="{{route('password.reset.email')}}" class="p-7 border-b" method="POST">
                    @csrf
                    <div class="flex mt-4">
                        <div class="w-full lg:w-2/5 mr-10">
                            <img class="w-full h-72 object-contain" src="{{asset('images/reset-password.png')}}" alt="alt reset-password">
                        </div>
                        <div class="w-full lg:w-3/5">
                            <h1 class="font-bold text-4xl text-black">{{ __('Password Reset') }}</h1>
                            <div class="form-group flex-shrink max-w-full my-7">
                                <label for="email" class="inline-block mb-4">{{ __('Enter The Email Address Associated With Your Account.') }}</label>
                                <input type="email" name="email" class="w-full leading-5 relative py-2 px-4 rounded text-gray-800 bg-white border border-gray-300 overflow-x-auto focus:outline-none focus:border-gray-400 focus:ring-0" placeholder="" required>
                            </div>
                            <x-button type="submit" class="py-3 md:px-10 font-semibold border-transparent">{{ __('Submit') }}</x-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const formValidation = function () {
            var mainForm = document.getElementById('main_form');
            var pristine = new Pristine(mainForm);

            mainForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const valid = pristine.validate();

                if (valid) {
                    mainForm.submit();
                }
            });
        };

        window.addEventListener("load", () => {
            formValidation();
        });
    </script>
</div>
