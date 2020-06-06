<div class="cate_left" id="product_filter">
    @if(!isset($keyword))
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
    @endif
    <div class="cate_left_brand">
        <p class="p_title_filter" style="font-size: 16px; padding-bottom: 10px;">Thương hiệu</p>
        <nav class="list-brand">
            <ul>
                @foreach($brands as $brand)
                <li class="">
                    <a><input class="sortBrand" data-id="{{ $brand->id }}" type="checkbox"> {{ $brand->name }}</a>
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
            <div class="width_common" id="amount">
                <input id="price_from" class="left" value="0" type="number"></input>
                <span> - </span>
                <input id="price_to" class="right" value="1000000" type="number"></input>
            </div>
            <button type="submit" class="submit_range">
                <i class="fa fa-caret-right"></i>
            </button>
        </div>
    </div>

</div>
