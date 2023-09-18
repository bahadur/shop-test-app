<?php

namespace App\Http\Controllers;

use App\Events\AccessCanceledEvent;
use App\Events\ProductPurchaseEvent;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

/**
 *
 */
class DashboardController extends Controller
{

    private ?StripeClient $stripeClient = null;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');

        $stripeKey = config('services.stripe.secret');
        Stripe::setApiKey($stripeKey);
    }

    public function stripeClient(): StripeClient
    {
        if ($this->stripeClient instanceof StripeClient) {
            return $this->stripeClient;
        }

        $secretKey = config('services.stripe.secret');
        return $this->stripeClient = app(StripeClient::class);
    }

    public function index()
    {
        $user = auth()->user();




        $isAdmin = $user->hasRole('admin');
        $users = [];
        if($isAdmin) {
            $users = User::where('id', '!=', $user->id)->get();
            $paymentMethods = [];
            $userRoles = [];
        } else {
            $paymentMethods = $user->paymentMethods();
            $userRoles = $user->getRoleNames();
        }
        return view('pages.dashboard.index', [
            'paymentMethods' => $paymentMethods,
            'userRoles' => $userRoles,
            'users' => $users,
            'isAdmin' => $isAdmin
        ]);
    }


    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function checkout($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::where('id', $id)->first();
        $user = auth()->user();
        return view('pages.dashboard.checkout', [
            'intent' => $user->createSetupIntent(),
            'product' => $product
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function singleCharge(Request $request): RedirectResponse
    {
        $amount = $request->price;
        $paymentMethodId = $request->payment_method;

        $user = auth()->user();

        $user->createOrGetStripeCustomer();

        $paymentMethod = $user->addPaymentMethod($paymentMethodId);

        $user->charge($amount * 100, $paymentMethod->id);

        $product = Product::where('id', $request->product_id)->first();
        $user->assignRole($product->product_type);

        event(new ProductPurchaseEvent($user->name, $user->email, $product));

        return to_route('home');
    }

    public function cancelAccess($id)
    {
        $user = User::where('id', $id)->first();

        $user->status == 'inactive';

        $user->save();
        event(new AccessCanceledEvent($user));
        return redirect()->back()->with('success', 'This use has been canceled access');
    }

}
