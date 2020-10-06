@extends('layouts.student.vapp')

@section('content')
<v-main>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <h2 class="grey--text text--darken-2">
                    {{ __('Reset Password') }}
                </h2>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4">
                <v-img 
                    src="https://meetuni.s3-ap-northeast-1.amazonaws.com/illustration/carry-on-colour1200px.png" 
                    cover 
                >
                </v-img>
            </v-col>
            <v-col cols="12" sm="12" md="4">
                <div class="pa-8">
                    <form method="POST" action="{{ route('student.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <v-row justify="center">
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field
                                    outlined
                                    type="email"
                                    name="email"
                                    label="E-mail Address"
                                    value="{{ $email ?? old('email') }}"
                                    v-bind:error="@error('email') true @else false @enderror"
                                    error-messages="@error('email') {{$message}} @enderror"
                                    required
                                    autocomplete="email"
                                    placeholder="example@example.com"
                                    autofocus
                                    readonly
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    label="New Password"
                                    type="password"
                                    name="password"
                                    v-bind:error="@error('password') true @else false @enderror"
                                    error-messages="@error('password') {{$message}} @enderror"
                                    required
                                    autocomplete="new-password"
                                ></v-text-field>
                                <v-text-field
                                    outlined
                                    label="Confirm New Password"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                ></v-text-field>
                                <v-btn type="submit" color="primary" text class="btn btn-link pa-0">
                                    {{ __('Reset Password') }}
                                </v-btn>
                                <v-col>
                        </v-row>
                    </form>
                </div>
            </v-col>
        </v-row>
    </v-container>
</v-main>
@endsection

