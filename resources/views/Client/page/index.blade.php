@extends('Client.layout.master')
@section('content')

@include('Client.layout.menu_index')
@include('Client.layout.banner')

@foreach($parent_categories as $key => $parent_category)
<section id="list_product_cate" class="width-common">
    <div class="wrap">
        <div class="category width-common">
            <div class="menu_subcate">
                <?php $color = \App\Helper\ServiceAction::COLOR_CATEGORIES[$key]; ?>
                <div class="box_title_cate" style="background-color: {{ $color }}">
                    <a href="{{ route('category', $parent_category->id) }}">
                        <img src="{{ $parent_category->imageIcon }}?mode=max&amp;width=60&amp;height=60" alt="{{ $parent_category->name }}">
                        <h2>{{ $parent_category->name }}</h2>
                    </a>
                </div>
                <div class="submenu_cate floor-30 item-{{ $key }}">
                    <ul>
                        <?php
                        $categories = \App\Category::where('parent_id', $parent_category->id)->get();
                        $array_categories_id = [];
                        ?>
                        @foreach($categories as $category)
                            <?php $array_categories_id[] = $category->id; ?>
                        <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('category', $parent_category->id) }}" class="seeall">Xem tất cả <i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
                <style>
                    .floor-30.submenu_cate.item-{{ $key }} ul li:hover {
                        background: {{ $color }};
                    }

                    .floor-30.submenu_cate ul li:hover a {
                        color: #fff;
                    }
                </style>
            </div>
            <div class="banner_cate">
                <a href="https://shoptretho.com.vn/danh-muc/cho-be-an"><img src="{{ $parent_category->imageSlide }}?mode=max&amp;width=375&amp;height=423" alt=""></a>
            </div>
            <?php
            $products = \App\Product::whereIn('category_id', $array_categories_id)->orderBy('id', 'desc')->limit(6)->get();
            ?>
            <div class="list_item">
            @foreach($products as $product)
                <div class="item">
                    <div class="image_item">
                        <?php $imageProduct = \App\ImageDetailProduct::where('product_id', $product->id)->first(); ?>
                        <a href="https://shoptretho.com.vn/sua-aptamil-anh-so-3-loai-moi" target="_blank">
                            <img src="{{ $imageProduct->image }}?mode=max&amp;width=400&amp;height=400" alt="{{ $product->name }}">

                        </a>
                    </div>
                    <h3>
                        <a href="https://shoptretho.com.vn/sua-aptamil-anh-so-3-loai-moi" target="_blank">{{ $product->name }}</a>
                    </h3>
                    <div class="price">
                        <?php
                            $price = $product->origin_price - ($product->origin_price * $product->discount / 100);
                            $price_show =  round($price/1000)* 1000;
                        ?>
                        <span class="price_item">{{ $price_show }}đ</span>
                        @if( $product->discount != 0 )
                        <span class="old_price">{{ $product->origin_price }}đ</span>
                        @endif
                    </div>
                    @if( $product->discount != 0 )
                    <span class="discount">-{{ $product->discount }}%</span>
                    @endif
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
@endforeach

@include('Client.layout.brands')
@endsection
