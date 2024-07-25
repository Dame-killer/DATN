<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\PaymentMethod;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $users = User::where('role', 0)->get();

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
            $order_detail->unit_price = $item['attributes']['product_price'];
            $order_detail->product_detail->size->size_name = $item['attributes']['size_name'];
            $order_detail->product_detail->size->size_number = $item['attributes']['size_number'];
            $order_detail->product_detail->color->name = $item['attributes']['color_name'];
            $order_detail->product_detail->color->code = $item['attributes']['color_code'];
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;

            $order_details[] = $order_detail;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        return view('admin.cart.index')->with(compact('users', 'order_details', 'totalPrice'));
    }

    public function cartCustomer()
    {
        // $users = User::where('role', 0)->get();

        $payment_methods = PaymentMethod::all();
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
            $order_detail->unit_price = $item['attributes']['product_price'];
            $order_detail->product_detail->size->size_name = $item['attributes']['size_name'];
            $order_detail->product_detail->size->size_number = $item['attributes']['size_number'];
            $order_detail->product_detail->color->name = $item['attributes']['color_name'];
            $order_detail->product_detail->color->code = $item['attributes']['color_code'];
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;

            $order_details[] = $order_detail;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        return view('customer.shoping-cart')->with(compact('order_details', 'totalPrice', 'payment_methods'));
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

        // Tính tổng giá từng sản phẩm và tổng giá tất cả các sản phẩm
        $totalPrice = 0;
        foreach ($order_details as $order_detail) {
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        return view('admin.order-detail.index', compact('orders', 'products', 'sizes', 'colors', 'product_details', 'order_details', 'totalPrice'));
    }

    public function showCustomer($id)
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

        // Tính tổng giá từng sản phẩm và tổng giá tất cả các sản phẩm
        $totalPrice = 0;
        foreach ($order_details as $order_detail) {
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        return view('customer.account-detail', compact('orders', 'products', 'sizes', 'colors', 'product_details', 'order_details', 'totalPrice'));
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

        // Kiểm tra số lượng sản phẩm chi tiết
        if ($product_detail->quantity <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$product_detail->id])) {
            // Nếu đã tồn tại, tăng số lượng lên 1
            $cart[$product_detail->id]['quantity']++;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart[$product_detail->id] = [
                'id' => $product_detail->id,
                'name' => $product_detail->product->name,
                'quantity' => 1,
                'attributes' => [
                    'product_code' => $product->code,
                    'product_name' => $product->name,
                    'product_image' => asset('storage/' . $product->image),
                    'product_price' => $product->price,
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

    public function addToCartCustomer(Request $request)
    {
        // Lấy số lượng sản phẩm từ request
        $quantity = $request->input('num_product', 1);
        $selectedSize = $request->input('selected_size');
        $selectedColor = $request->input('selected_color');
        $productId = $request->input('product_id');

        // Tìm product detail dựa trên size và color đã chọn
        $product_detail = ProductDetail::where('product_id', $productId)
            ->whereHas('size', function ($query) use ($selectedSize) {
                $query->where('size_name', $selectedSize);
            })->whereHas('color', function ($query) use ($selectedColor) {
                $query->where('id', $selectedColor);
            })->firstOrFail();

        // Kiểm tra số lượng sản phẩm chi tiết
        if ($product_detail->quantity <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        $cart = session()->get('cart', []);

        // Lấy thông tin chi tiết sản phẩm
        $product = $product_detail->product;
        $size = $product_detail->size;
        $color = $product_detail->color;
        $productDetailId = $product_detail->id;

        if (isset($cart[$productDetailId])) {
            // Nếu đã tồn tại, tăng số lượng lên
            $cart[$productDetailId]['quantity'] += $quantity;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart[$productDetailId] = [
                'id' => $product_detail->id,
                'name' => $product_detail->product->name,
                'quantity' => $quantity,
                'attributes' => [
                    'product_code' => $product->code,
                    'product_name' => $product->name,
                    'product_image' => asset('storage/' . $product->image),
                    'product_price' => $product->price,
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

    public function updateQuantity(Request $request)
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$request->id])) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $productDetail = DB::table('product_details')->where('id', $request->id)->first();

            if (!$productDetail) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sản phẩm không tồn tại!'
                ]);
            }

            // Kiểm tra và cập nhật số lượng sản phẩm
            if ($request->action == 'increase' && $cart[$request->id]['quantity'] < $productDetail->quantity) {
                $cart[$request->id]['quantity']++;
            } elseif ($request->action == 'decrease' && $cart[$request->id]['quantity'] > 1) {
                $cart[$request->id]['quantity']--;
            }
        }

        // Tính tổng tiền
        foreach ($cart as $item) {
            $totalPricePerProduct = $item['attributes']['product_price'] * $item['quantity'];
            $totalPrice += $totalPricePerProduct;

            if ($item['id'] == $request->id) {
                $updatedItem = [
                    'amount' => $item['quantity'],
                    'totalPricePerProduct' => $totalPricePerProduct
                ];
            }
        }

        // Cập nhật lại session với giỏ hàng mới
        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'amount' => $updatedItem['amount'],
            'totalPricePerProduct' => number_format($updatedItem['totalPricePerProduct']),
            'totalPrice' => number_format($totalPrice)
        ]);
    }
}
