<?php

namespace App\Http\Controllers;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function cart()
    {
        $cart = session()->get('cart', []); // Lấy nội dung giỏ hàng từ session

        $order_details = [];

        $totalPrice = 0;

        foreach ($cart as $item) {
            // Tạo một đối tượng OrderDetail tạm thời để hiển thị trên view
            $order_detail = new \stdClass();
            $order_detail->product_detail = new \stdClass();
            $order_detail->product_detail->product = new \stdClass();
            $order_detail->product_detail->color = new \stdClass();
            $order_detail->product_detail->size = new \stdClass();

            $order_detail->product_detail->id = $item['id'];
            $order_detail->product_detail->product->code = $item['attributes']['product_code'];
            $order_detail->product_detail->product->name = $item['name'];
            $order_detail->product_detail->product->image = $item['attributes']['product_image'];
            $order_detail->amount = $item['quantity'];
            $order_detail->price = $order_detail->amount * $item['price'];
            $order_detail->product_detail->size->size_name = $item['attributes']['size_name'];
            $order_detail->product_detail->size->size_number = $item['attributes']['size_number'];
            $order_detail->product_detail->color->name = $item['attributes']['color_name'];
            $order_detail->product_detail->color->code = $item['attributes']['color_code'];

            $order_details[] = $order_detail;
            $totalPrice += $order_detail->price;
        }

        return view('admin.cart.index')->with(compact('order_details', 'totalPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orders = Order::findOrFail($id);
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        $product_details = ProductDetail::all();
        $order_details = OrderDetail::with('productDetail', 'productDetail.product', 'productDetail.size', 'productDetail.color')->where('order_id', $id)->get();

        // Kiểm tra nếu không có chi tiết đơn hàng
        if ($order_details->isEmpty()) {
            throw new \Exception('Không tìm thấy chi tiết đơn hàng!');
        }

        $totalPrice = $order_details->sum('price');

        return view('admin.order-detail.index', compact('orders', 'products', 'sizes', 'colors', 'product_details', 'order_details', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addToCart(ProductDetail $product_detail)
    {
        $cart = session()->get('cart', []);

        // Lấy thông tin chi tiết sản phẩm
        $product = $product_detail->product;
        $size = $product_detail->size;
        $color = $product_detail->color;

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$product_detail->id])) {
            // Nếu đã tồn tại, tăng số lượng lên 1
            $cart[$product_detail->id]['quantity']++;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart[$product_detail->id] = [
                'id' => $product_detail->id,
                'name' => $product_detail->product->name,
                'price' => $product_detail->price,
                'quantity' => 1,
                'attributes' => [
                    'product_code' => $product->code,
                    'product_name' => $product->name,
                    'product_image' => asset('storage/' . $product->image),
                    'size_name' => $size->size_name,
                    'size_number' => $size->size_number,
                    'color_name' => $color->name,
                    'color_code' => $color->code
                ]
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }

    public function removeFromCart($product_detail)
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$product_detail])) {
            // Remove the product from the cart
            unset($cart[$product_detail]);

            // Update the cart session
            session()->put('cart', $cart);
        }

        // Redirect về trang giỏ hàng với thông báo thành công
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
