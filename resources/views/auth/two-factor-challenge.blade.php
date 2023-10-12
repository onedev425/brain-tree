@extends('layouts.guest')

@section('title', 'Two Factor Challenge')

@section('body')
    <x-partials.authentication-card class="w-8/12 md:w-7/12 lg:w-6/12 xl:w-5/12">
        <div class="w-full md:w-full px-4 sm:px-8 md:px-16 pt-3 pb-10">
            <div class="flex flex-cols justify-center items-center">
                <a href="#"><img src="{{asset(config('app.logo'))}}" alt="" class="my-4"></a>
            </div>

            <x-display-validation-errors />
            <div x-data="{ recovery: false }">
                <form method="POST" action="{{ route('two-factor.login') }}">
                    @csrf
                    <div class="flex mt-4">
                        <div class="w-full lg:w-2/5 mr-10">
                            <img class="w-full h-64 object-contain" src="{{asset('images/verification-code.png')}}" alt="alt verification-code">
                        </div>
                        <div class="w-full lg:w-3/5">
                            <h2 class="mb-3 text-3xl md:text-2xl font-bold">
                                {{ __('Two-Factor Authentication') }}
                            </h2>
                            <div class="mb-3 text-sm md:text-base">
                                {{ __('Please confirm access to your account by entering in the authenticating code provided by the authenticator application.') }}
                            </div>
                            <div class="form-group" x-show="! recovery">
                                <x-input id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                            </div>

                            <div class="form-group" x-show="recovery">
                                <x-input label="Recovery Code" id="recovery-code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                            </div>

                            <div class="flex justify-end mt-3">
                                <x-button type="button" class="bg-gray-800"
                                        x-show="! recovery"
                                        x-on:click="
                                                    recovery = true;
                                                    $nextTick(() => { $refs.recovery_code.focus() })
                                                ">
                                    {{ __('Use a recovery code') }}
                                </x-button>

                                <x-button type="button" class="bg-gray-800 text-xs md:text-base px-2"
                                        x-show="recovery"
                                        x-on:click="
                                                    recovery = false;
                                                    $nextTick(() => { $refs.code.focus() })
                                                ">
                                    {{ __('Use an authentication code') }}
                                </x-button>

                                <x-button class="px-2 md:px-6">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-partials.authentication-card>
@endsection

