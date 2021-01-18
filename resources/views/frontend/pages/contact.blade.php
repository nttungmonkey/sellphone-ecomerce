@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        .li-header-4 .header-bottom {
            background: #293a6c;
            border-top: 1px solid rgba(255,255,255,.1);
            color: #ffffff;
            margin-bottom: 0px;
        }
        .error {
            color: red;
        }
        .valid {
            color: green;
        }
    </style>
@endsection
@section('content')
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{ route('pages.home') }}">Home</a></li>
                            <li class="active">Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->     
            <!-- Begin Contact Main Page Area -->
            <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
                <div class="container mb-60">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d292.00945951364787!2d105.77981789640458!3d10.033741947759388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfa43fbeb2b00ca73!2sCUSC%20-%20Cantho%20University%20Software%20Center!5e0!3m2!1sen!2s!4v1610622825433!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                            <div class="contact-page-side-content">
                                <h3 class="contact-page-title">Contact Us</h3>
                                <p class="contact-page-message mb-25">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.</p>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-fax"></i> Address</h4>
                                    <p>01 Ly Tu Trong Street, Ninh Kieu District, Can Tho City</p>
                                </div>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-phone"></i> Phone</h4>
                                    <p>Mobile: 0964-318-083</p>
                                    <p>Hotline: 1900 123456</p>
                                </div>
                                <div class="single-contact-block last-child">
                                    <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                    <p>phonetn2020@gmail.com</p>
                                    <p>support@phonetn.company</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 order-2 order-lg-1" ng-controller="contactController">
                            <div class="contact-form-content pt-sm-55 pt-xs-55">
                                <h3 class="contact-page-title">{{ __('phonetn.contact') }}</h3>
                                <div class="contact-form">
                                    <form name="contactForm" ng-submit="submitContactForm()" novalidate>
                                        <div class="form-group">
                                            <label>Your Name <span class="required">*</span></label>
                                            <input type="text" name="customerName" id="customerName" ng-model="customerName" ng-minlength="2" ng-maxlength="50" ng-required="true">
                                            <span class="error" ng-show="contactForm.customerName.$error.required">Vui lòng nhập họ tên</span>
                                            <span class="error" ng-show="contactForm.customerName.$error.minlength">Họ tên tối thiểu 2 ký tự</span>
                                            <span class="error" ng-show="contactForm.customerName.$error.maxlength">Họ tên tối đa  ký tự</span>   
                                            <span class="valid" ng-show="contactForm.customerName.$valid">Hợp lệ</span>      
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email <span class="required">*</span></label>
                                            <input type="text" name="customerEmail" id="customerEmail" ng-model="customerEmail" ng-pattern="/^.+@gmail.com$/" ng-required=true>
                                            <span class="error" ng-show="contactForm.customerEmail.$error.required">Vui lòng nhập email</span>
                                            <span class="error" ng-show="!contactForm.customerEmail.$error.required&&contactForm.customerEmail.$error.pattern">Chỉ
                                                chấp nhập GMAIL, vui lòng kiểm tra lại</span>
                                            <span class="valid" ng-show="contactForm.customerEmail.$valid">Hợp lệ</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" name="contactSubject" id="contactSubject" ng-model="contactSubject">
                                        </div>
                                        <div class="form-group mb-30">
                                            <label>Your Message</label>
                                            <textarea name="contactMessage" id="contactMessage" ng-model="contactMessage"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="li-btn-3" ng-disabled="contactForm.$invalid">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Main Page Area End Here -->
@endsection
@section('custom-scripts')
    <!-- Google Map -->
    
    <script>
        app.controller('contactController', function($scope, $http){
            $scope.submitContactForm = function(){
                if ($scope.contactForm.$valid){
                    var dataInputContactForm = {
                        "customerName": $scope.contactForm.customerName.$viewValue,
                        "customerEmail": $scope.contactForm.customerEmail.$viewValue,
                        "contactSubject": $scope.contactForm.contactSubject.$viewValue,
                        "contactMessage": $scope.contactForm.contactMessage.$viewValue,
                        "_token": "{{ csrf_token() }}"
                    }
                    $http({
                        url: "{{ route('pages.email-to-contact') }}",
                        method: "POST",
                        data: JSON.stringify(dataInputContactForm)
                    }).then(function successCallback(response){
                        swal('Successfully!', 'We will reply to you in the shortest time.', 'success');
                    },
                    function successCallback(response){
                        swal('There is an error in the processing!', 'Please try again in a few minutes.', 'error');
                        console.log(response);
                    });
                }
            }
            
        });
    </script>      
@endsection