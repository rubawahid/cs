 <!-- Start Single category -->
 <div class="single-category">
                        <div class="category-image">
                            <img src="{{ $category->image_url }}" alt="#">
                            <div class="button">
                                <a href="{{ route('shop.categories.show', $category->slug) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <div class="category-info">
                            <span class="category">{{ $category->category()->first()->name}}</span>
                            <h4 class="title">
                                <a href="{{ route('shop.categories.show', $category->slug) }}">{{ $category->name }}</a>
                            </h4>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star"></i></li>
                                <li><span>4.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                {{ $category->price_formatted }}
                                @if ($category->compare_price)
                                <span class="discount_price">{{ $category->compare_price_formatted }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Single category -->