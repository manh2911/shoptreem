<div class="cate_left" id="product_filter">
    <div class="cate_left_title">
        Danh mục liên quan
    </div>
    <div class="title_cate_related">
        {{ $currentCategory->name }}
    </div>
    <ul class="cate_related">
        @foreach($relateCategories as $relateCategory)
        <li><a href="{{ route('category', $relateCategory->id) }}">{{ $relateCategory->name }}</a></li>
        @endforeach
    </ul>
    <div class="cate_left_brand">
        <p class="p_title_filter" style="font-size: 16px; padding-bottom: 10px;">Thương hiệu</p>
        <nav class="list-brand">
            <ul>
                @foreach($brands as $brand)
                <li class="">
                    <a href="javascript:;" rel="nofollow"
                       onclick="javascript:loadPageFull('/Desktop/CategoryDesktop/ProductList?permalink=cho-be-an&amp;provider=abbott&amp;page=1&amp;categoryId=30&amp;PageKey=Cate');">
                        <input type="checkbox"> {{ $brand->name }}</a>
                </li>
                @endforeach
            </ul>
        </nav>
        <style>
            .list-brand ul{height:200px; width:100%;}
            .list-brand ul{overflow:hidden; overflow-y:scroll;}
        </style>
    </div>
    <div class="cate_left_price">
        <p class="p_title_filter">Giá</p>
        <div class="option_price">
            <div id="slider-range" data-min="0" data-max="6500000" data-step="100000" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                <div id="slider_range_from" class="left"></div>
                <div id="slider_range_to" class="right"></div>
                <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
            <div class="width_common" id="amount">
                <div id="price_from" class="left">0</div>
                <span> - </span>
                <div id="price_to" class="right">6.500.000</div>
            </div>
            <input type="hidden" name="price" id="priceFilter" value="0-6500000">
            <button type="submit" class="submit_range" onclick="javascript:PriceFilter(this, '/Desktop/CategoryDesktop/ProductList?permalink=cho-be-an&amp;page=1&amp;categoryId=30&amp;PageKey=Cate');return false;"><i class="fa fa-caret-right"></i></button>
        </div>
    </div>

</div>
