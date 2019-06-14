<?php

namespace App\Http\Controllers;

use App\Commande;
use App\CommandState;
use App\Facture;
use App\Commandearticle;
use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Array_;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    public function index()
    {
        return route('kring');
    }

    public function cart()
    {
        return view('webshop.cart');
    }

    public function addToCart($id)
    {
        $product = Article::find($id);

        if (!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "name" => $product->Description,
                    "quantity" => 1,
                    "price" => $product->prix,
                    "photo" => $product->img
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->Description,
            "quantity" => 1,
            "price" => $product->prix,
            "photo" => $product->img
        ];

        session()->put('cart', $cart);


        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function postCommande(Request $request)
    {
        $comState = new CommandState;
        $comState->Lib_etatcom = "V";
        $comState->Date_etat = Carbon::now()->toDateTimeString();
        $comState->save();

        $facture = new Facture;
        $facture->Date_fac = Carbon::now()->toDateTimeString();
        $facture->remise = "0%";
        $facture->TVA = "20%";
        $facture->prix = $request->prix;
        $facture->save();

        $commande = new Commande;
        $commande->Date_com = Carbon::now()->toDateTimeString();
        $commande->ClientID = Auth::id();
        $commande->EtatDeCommandeID = $comState->id;
        $commande->factureID = $facture->id;
        $commande->save();


        $myItems = [
            ['ArticleID' => $request->ArticleID, 'CommandeID' => $commande->id]
        ];

        DB::table("commandearticle")->insert($myItems);


        return view('webshop.postachat')->with([
            'flash_message' => 'Merci pour votre achat !',
            'flash_message_important' => false
        ]);
    }



    public function remove(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
