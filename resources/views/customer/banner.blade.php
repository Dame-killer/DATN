<!-- Banner -->
<div class="sec-banner bg0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-6 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('assets/images/banner1.webp') }}" alt="IMG-BANNER">
                    <a href="{{ route('customer-product') }}"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        {{-- <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Women
                            </span>
                            <span class="block1-info stext-102 trans-04">
                                Spring 2018
                            </span>
                        </div> --}}
                        {{-- <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                MUA NGAY
                            </div>
                        </div> --}}
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 m-lr-auto">
                <!-- Block1 -->
                <div class="block1 wrap-pic-w">
                    <img src="{{ asset('assets/images/banner2.webp') }}" alt="IMG-BANNER">
                    <a href="{{ route('customer-product') }}"
                        class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                        {{-- <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                Men
                            </span>
                            <span class="block1-info stext-102 trans-04">
                                Spring 2018
                            </span>
                        </div> --}}
                        {{-- <div class="block1-txt-child2 p-b-4 trans-05">
                            <div class="block1-link stext-101 cl0 trans-09">
                                MUA NGAY
                            </div>
                        </div> --}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sec-banner {
        padding-top: 0;
        padding-bottom: 0;
        height: 75vh;
        width: 100%;
        /* Occupies 75% of the viewport height */
        background-color: #ffffff;
        /* Brighter background */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        height: 100%;
    }

    .row {
        height: 100%;
    }

    .block1 {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        /* Rounded corners */
        /* box-shadow: 0 4px 8px rgba(255, 247, 247, 0.1); */
        /* Soft shadow */
        transition: transform 0.3s ease-in-out;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .block1 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
        /* Rounded corners for images */
        transition: opacity 0.3s ease-in-out;
    }

    .block1:hover {
        transform: translateY(-10px);
    }

    .block1:hover img {
        opacity: 0.9;
    }

    .block1-txt {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 34px 38px;
        /* background: rgba(0, 0, 0, 0.3); */
        /* Darker overlay for contrast */
        border-radius: 15px;
        /* Rounded corners for overlay */
    }

    .block1-txt-child1 .block1-name {
        font-size: 24px;
        color: #000000;
        /* White text for better contrast */
    }

    .block1-txt-child1 .block1-info {
        font-size: 18px;
        color: #000000;
        /* Lighter text for better contrast */
    }

    .block1-link {
        background-color: #000;
        /* Darker background for button */
        padding: 10px 20px;
        border-radius: 5px;
        color: #fff;
        /* White text for button */
        text-transform: uppercase;
        transition: background-color 0.3s ease-in-out;
    }

    .block1-link:hover {
        background-color: #333;
        /* Slightly lighter on hover */
    }
</style>
