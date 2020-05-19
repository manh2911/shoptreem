<div class="nav_cate width-common">
    <ul>
        <li class="cate_home nav_top">
            <i class="fa fa-bars"></i>Danh mục
            <div class="box_list_cate">
                <div class="menu_cate">
                    <div>
                        <ul>
                            @foreach($parent_categories as $key => $parent_category)
                            <li class="cate_li menu-{{ $key }} menu-item-{{ $key }} menu_cate">

                                    <a href="{{ route('category', $parent_category->id) }}" class="cate_li_title">
                                        <img class="img_icon icon_color" style="filter: invert(100%);" src="{{ $parent_category->imageIcon }}?mode=max&amp;width=60&amp;height=60" alt="{{ $parent_category->name }}">
                                        <img class="img_icon icon_hover" src="{{ $parent_category->imageIcon }}?mode=max&amp;width=60&amp;height=60" alt="{{ $parent_category->name }}">
                                        {{ $parent_category->name }}
                                    </a>
                                    <div class="cate_hover">
                                        <div class="subcate_hover">
                                            <div class="cate_hover_title">{{ $parent_category->name }}</div>
                                            <ul class="submenu_cate_hover">
                                                <?php
                                                $categories = \App\Category::where('parent_id', $parent_category->id)->get();
                                                ?>
                                                @foreach($categories as $category)
                                                    <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="img_hover">
                                            <a><img alt=""></a>
                                        </div>
                                    </div>
                                    <style>
                                        .menu-item-{{ $key }}.menu-{{ $key }}.menu_hover .menu_cate {
                                            border-top: 1px solid {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                        }

                                        .menu-{{ $key }}.cate_li.menu-item-{{ $key }}.hover {
                                            background: {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                        }

                                        .menu-{{ $key }}.subcate_hover {
                                            border: 1px solid {{ \App\Helper\ServiceAction::COLOR_CATEGORIES[$key] }};
                                        }
                                    </style>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </li>
        <li class="nav_top">
            <a href="{{ route('index') }}">Trang chủ</a>
        </li>
        @if($currentCategory->parent_id != 0)
        <li class="nav_top main_cate">
            <?php
                $parentCurrentCategory = \App\Category::findOrFail($currentCategory->parent_id);
            ?>
            <a href="{{ route('category',  $parentCurrentCategory->id) }}">
                <i class="fa fa-angle-right"></i>
                {{ $parentCurrentCategory->name }}
            </a>
        </li>
        @endif
        <li class="nav_top main_cate">
            <a href="{{ route('category',  $currentCategory->id) }}">
                <i class="fa fa-angle-right"></i>
                {{ $currentCategory->name }}
            </a>
        </li>
    </ul>
</div>
