@extends('Client.layout.master')
@section('content')
<section class="category_content width-common">
    <div class="wrap">
        @include('Client.layout.menu_page')
        <div class="main_content width-common">
            @include('Client.layout.menu_left_category')
            <div class="cate_right" id="product_cate">
                <input id="pageUrl" name="pageUrl" type="hidden" value="?page=1&amp;categoryId=30">
                <div class="title_cate_right" sortex="" sortdir="">
                <h1 class="title_cate">{{ $currentCategory->name }}</h1>
                    <span class="title_filter">
                    sắp xếp theo
                    <select name="sortProduct" id="sortProduct" onchange="javascript:SortProduct(this, '/Desktop/CategoryDesktop/ProductList?permalink=cho-be-an&amp;page=1&amp;categoryId=30&amp;PageKey=Cate');">
                        <option value="{{ \App\Helper\ServiceAction::SORT_RANDOM }}">Ngẫu nhiên</option>
                        <option value="{{ \App\Helper\ServiceAction::SORT_PRICE_ASC }}">Giá tăng dần</option>
                        <option value="{{ \App\Helper\ServiceAction::SORT_PRICE_DESC }}">Giá giảm dần</option>
                        <option value="{{ \App\Helper\ServiceAction::SORT_NAME_ASC }}">Tên A-&gt;Z</option>
                        <option value="{{ \App\Helper\ServiceAction::SORT_NAME_DESC }}">Tên Z-&gt;A</option>
                        <option value="{{ \App\Helper\ServiceAction::SORT_DISCOUNT }}">Khuyến mại</option>
                    </select>
                </span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="list_item_cate">
                    @foreach($products as $product)
                        <?php
                            $firstImage = \App\ImageDetailProduct::where('product_id', $product->id)->first();
                        ?>
                    <div class="product">
                        <div class="product_child">
                            <div class="pro_img">
                                <a href="{{ route('product', $product->id) }}" target="_blank"
                                   title="{{ $product->name }}"><img
                                        src="{{ $firstImage->image }}"
                                        alt="{{ $product->name }}"></a>
                            </div>
                            <h3 class="name_pro">
                                <a href="{{ route('product', $product->id) }}" target="_blank"
                                   title="{{ $product->name }}">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <div class="product_price">
                                <span class="price_item">
                                    <?php
                                    $price = $product->origin_price - ($product->origin_price * $product->discount / 100);
                                    $price_show =  round($price/1000)* 1000;
                                    ?>
                                    {{ $price_show }}đ
                                </span>
                                @if($product->discount != 0)
                                <span class="old_price">{{ $product->origin_price }}</span>
                                @endif
                            </div>
                            @if($product->discount != 0)
                            <span class="discount">-{{ $product->discount }}%</span>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="pagination">
                    <ul>
                        {!! $products->links() !!}
                    </ul>
                    <div class="clear"></div>

                </div>

            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="background_black">
    </div>
</section>
@endsection
