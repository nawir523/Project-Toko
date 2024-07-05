<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Shoe; // Pastikan menggunakan namespace yang benar sesuai dengan model Shoe

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');

        $shoes = Shoe::query();

        if ($keyword) {
            $shoes->where(function ($query) use ($keyword) {
                $query->where('namamerk', 'like', "%$keyword%")
                    ->orWhere('ukuran', 'like', "%$keyword%")
                    ->orWhere('tipe', 'like', "%$keyword%")
                    ->orWhere('jenis', 'like', "%$keyword%")
                    ->orWhere('harga', 'like', "%$keyword%");
            });
        }

        $shoes = $shoes->get();

        return view('home', compact('shoes', 'keyword'));
    }
 
    public function adminHome()
    {
        return view('dashboard');
    }
}