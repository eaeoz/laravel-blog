@extends('front.layouts.master')
@section('title', 'Contact')
@section('image', 'https://sperloscivil.ir/wp-content/uploads/2022/03/header-Contact-us.jpg')
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="contact-us">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="down-contact">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="sidebar-item contact-form">


                                            <form method="POST" action="{{ route('contact.post') }}" novalidate>
                                                @csrf
                                                <div class="control-group">
                                                    <div class="form-group floating-label-form-group controls">
                                                        <label>Name</label>
                                                        <input type="text" value='{{ old('name') }}'
                                                            class="form-control" placeholder="Type your Name" name='name'
                                                            required data-validation-required-message='Place name here'>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="form-group floating-label-form-group controls">
                                                        <label>E-mail Adress</label>
                                                        <input type="text" value='{{ old('email') }}'
                                                            class="form-control" placeholder="Type your E-mail"
                                                            name='email' required
                                                            data-validation-required-message='Place email here'>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                                        <label>Subject</label>
                                                        <select class='form-control' name="topic">
                                                            <option @if (old('topic') == 'Information') selected @endif
                                                                value="Information">
                                                                Information
                                                            </option>
                                                            <option @if (old('topic') == 'Support') selected @endif
                                                                value="Support">
                                                                Support
                                                            </option>
                                                            <option @if (old('topic') == 'General') selected @endif
                                                                value="General">
                                                                General
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <div class="form-group floating-label-form-group controls">
                                                        <label>Message</label>
                                                        <textarea rows="5" class="form-control" placeholder="Type your Message Here" name='message' required
                                                            data-validation-required-message='Place message here'>{{ old('message') }}</textarea>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="sendMessageButton">Send</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="sidebar-item contact-information">
                                            <div class="sidebar-heading">
                                                <br>
                                                <h2>Contact Information</h2>
                                            </div>
                                            <div class="content">
                                                <ul>
                                                    <li>
                                                        <h5>090-484-8080</h5>
                                                        <span>PHONE NUMBER</span>
                                                    </li>
                                                    <li>
                                                        <h5>info@company.com</h5>
                                                        <span>EMAIL ADDRESS</span>
                                                    </li>
                                                    <li>
                                                        <h5>123 Aenean id posuere dui,
                                                            <br>Praesent laoreet 10660
                                                        </h5>
                                                        <span>STREET ADDRESS</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <div id="map">
                                <iframe
                                    src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
