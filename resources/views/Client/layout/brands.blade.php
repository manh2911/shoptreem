<section id="brand" class="width-common jcarousel-wrapper">
    <div class="wrap jcarousel">
        <ul>
            @foreach($brands as $brand)
            <li>
                <a href="https://shoptretho.com.vn/thuong-hieu/sai-gon-food"><img src="{{ $brand->image }}?mode=max&amp;width=130&amp;height=78" alt="{{ $brand->name }}"></a>
            </li>
            @endforeach
        </ul>
    </div>
</section>
