<section class="trending-category section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ $title }}</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-lg-3 col-md-6 col-12">
                   <x-category-card :category="$category" />
                </div>
              @endforeach
                    <!-- Start Single category -->
                    <div class="single-category">
                        <div class="category-image">
                            <img src="{{ $category->image_url }}" alt="#">
                            <div class="button">
                                <a href="category-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <div class="category-info">
                            <span class="category">Laptop</span>
                            <h4 class="title">
                                <a href="category-grids.html">{{ $category->name }}</a>
                            </h4>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                                <span>{{ $category->price_formatted }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Single category -->
                
            </div>
        </div>
    </section>