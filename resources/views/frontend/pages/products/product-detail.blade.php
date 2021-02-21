<?php use App\Http\Controllers\Frontend\PageController; ?>

<div id="product-details" class="tab-pane" role="tabpanel">
    <div class="product-details-manufacturer">
        <a href="#">
            <img src="{{ asset('storage/images/products/imgs/'.$data->pro_image)  }}" alt="Product Manufacturer Image">
        </a>
        <br/>
        <p align="justify">
            <span>
                {{-- {!! $data->pro_detail !!} --}}
            </span>
            
        </p>
        {!! PageController::showDetail($data->pro_detail);  !!}
       

    </div>
</div>