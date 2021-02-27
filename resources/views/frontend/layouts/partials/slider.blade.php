<div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Slider Area -->
                        <div class="col-lg-8 col-md-8">
                            <div class="slider-area pt-sm-30 pt-xs-30">
                                <div class="slider-active owl-carousel">
                                    <!-- Begin Single Slide Area -->
                                    @foreach ($product as $sp)
                                        <div class="single-slide align-center-left animation-style-01 bg-1" >
                                            <div class="slider-progress"></div>
                                            <div class="slider-content">
                                                <h5>Siêu phẩm của <b>{{ $sp->mod_name }} </b> </h5>
                                                <h2> {{ $sp->pro_name }}</h2>
                                                <h3>Giá chỉ <span>{{ number_format($sp->imd_priceExp * 1000, 0, ' ', ',') . ' VNĐ'}} </span></h3>
                                                <div class="default-btn slide-btn">
                                                    <a class="links" href="{{ route('pages.productdetail', ['id' => $sp->pro_sku]) }}">Sở hữu ngay</a>
                                                </div>
                                            </div>
                                            <img src="{{ asset('storage/images/products/imgs/'.substr($sp->pro_image,0,-4).'-0.png') }}" alt="" >
                                        </div>
                                    @endforeach
                                    <!-- Single Slide Area End Here -->
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                        <!-- Begin Li Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center pt-sm-30 pt-xs-30">
                            
                            <div class="li-banner">
                                <a href="{{ route('pages.productdetail', ['id' => $iQC[0]->pro_sku]) }}">
                                    <img src="{{ asset('storage/images/products/imgs/'. $iQC[0]->reimg_name ) }}" alt="" height="230px">
                                </a>
                            </div>

                            <div class="li-banner mt-15 mt-md-30 mt-xs-25 mb-xs-5">
                                <a href="{{ route('pages.productdetail', ['id' => $iQC[1]->pro_sku]) }}">
                                    <img src="{{ asset('storage/images/products/imgs/'. $iQC[1]->reimg_name ) }}" alt="" height="230px">
                                </a>
                            </div>
                        </div>
                        <!-- Li Banner Area End Here -->
                    </div>
                </div>
            </div>