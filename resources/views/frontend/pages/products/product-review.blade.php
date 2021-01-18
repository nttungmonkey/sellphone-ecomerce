<div id="reviews" class="tab-pane" role="tabpanel">
    <div class="product-reviews">
        <div class="product-details-comment-block">
            <div class="comment-review">
                <span>Grade</span>
                <ul class="rating">
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li><i class="fa fa-star-o"></i></li>
                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                </ul>
            </div>
            <div class="comment-author-infos pt-25">
                <span>HTML 5</span>
                <em>01-12-18</em>
            </div>
            <div class="comment-details">
                <h4 class="title-block">Demo</h4>
                <p>Plaza</p>
            </div>
            <div class="review-btn">
                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
            </div>
            <!-- Begin Quick View | Modal Area -->
            <div class="modal fade modal-wrapper" id="mymodal" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 class="review-page-title">Write Your Review</h3>
                            <div class="modal-inner-area row">
                                <div class="col-lg-6">
                                    <div class="li-review-product">
                                        <img src="{{ asset('storage/images/customer/product/large-size/3.jpg') }}" alt="Li's Product">
                                        <div class="li-review-product-desc">
                                            <p class="li-product-name">Today is a good day Framed poster</p>
                                            <p>
                                                <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Design </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="li-review-content">
                                        <!-- Begin Feedback Area -->
                                        <div class="feedback-area">
                                            <div class="feedback">
                                                <h3 class="feedback-title">Our Feedback</h3>
                                                <form action="#">
                                                    <p class="your-opinion">
                                                        <label>Your Rating</label>
                                                        <span>
                                                            <select class="star-rating">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </span>
                                                    </p>
                                                    <p class="feedback-form">
                                                        <label for="feedback">Your Review</label>
                                                        <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                    </p>
                                                    <div class="feedback-input">
                                                        <p class="feedback-form-author">
                                                            <label for="author">Name<span class="required">*</span>
                                                            </label>
                                                            <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                        </p>
                                                        <p class="feedback-form-author feedback-form-email">
                                                            <label for="email">Email<span class="required">*</span>
                                                            </label>
                                                            <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                            <span class="required"><sub>*</sub> Required fields</span>
                                                        </p>
                                                        <div class="feedback-btn pb-15">
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                            <a href="#">Submit</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Feedback Area End Here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <!-- Quick View | Modal Area End Here -->
        </div>
    </div>
</div>