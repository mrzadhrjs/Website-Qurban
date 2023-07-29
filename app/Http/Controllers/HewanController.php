<?php

namespace App\Http\Controllers;
use App\Models\Hewan;
use App\Models\GradeBobot;
use App\Models\Grade;
use App\Models\History;
use App\Models\HistoryTransaksi;
use App\Models\Bobot;
use App\Models\Keranjang;
use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class HewanController extends Controller
{

    private function calculateShippingCost($yourAddress, $userAddress){
    $yourCoordinates = $this->getCoordinatesFromAddress($yourAddress);
    $userCoordinates = $this->getCoordinatesFromAddress($userAddress);

    $status = '';
    $ongkir = 0;
    $distance = 0;

    if ($yourCoordinates && $userCoordinates) {
        $distance = $this->calculateDistance(
            $yourCoordinates['latitude'],
            $yourCoordinates['longitude'],
            $userCoordinates['latitude'],
            $userCoordinates['longitude']
        );

        if ($distance <= 30) {
            $status = 'Gratis ongkir! karena jarak kurang dari 30 km';
            $ongkir = 0;
        } elseif ($distance > 30 && $distance < 80) {
            $status = 'Jarak lebih dari 30 km, akan dikenakan ongkir Rp200.000';
            $ongkir = 200000;
        } else {
            $status = 'Tidak bisa menerima pembelian dengan jarak lebih dari 80 km';
            $ongkir = 0;
        }
    }

    return compact('status', 'ongkir', 'distance');
}


    public function aboutus(){

        $yourAddress = 'Klapanunggal';
            # code...
            if (Auth::check()) {
                // User is authenticated, access the address.
                $userAddress = Auth::user()->alamat;
            } else {
                // Handle the case where the user is not authenticated (guest).
                // For example, you can set a default address or provide a message to guests.
                $userAddress = 'Guest Address';
            }
            
            $shippingData = $this->calculateShippingCost($yourAddress, $userAddress);

            $status = $shippingData['status'];
            $ongkir = $shippingData['ongkir'];
            $distance = $shippingData['distance'];

            $hewan = Hewan::all();
            $grade = Grade::all();
            $bobot = Bobot::all();
            $gb = GradeBobot::all();
            $history = History::all();
            $ht = HistoryTransaksi::all();
            $transaksi = Transaction::all();
            $keranjang = Keranjang::all();
            return view('about', compact('ongkir' ,'distance', 'status', 'hewan', 'bobot', 'grade', 'gb', 'keranjang', 'transaksi', 'history', 'ht'));
    }

    public function index(){

        $yourAddress = 'Klapanunggal';
            if (Auth::check()) {
                $userAddress = Auth::user()->alamat;
            } else {
                $userAddress = 'Guest Address';
            }
            
            $shippingData = $this->calculateShippingCost($yourAddress, $userAddress);

            $status = $shippingData['status'];
            $ongkir = $shippingData['ongkir'];
            $distance = $shippingData['distance'];

            $hewan = Hewan::all();
            $grade = Grade::all();
            $bobot = Bobot::all();
            $gb = GradeBobot::all();
            $history = History::all();
            $ht = HistoryTransaksi::all();
            $transaksi = Transaction::all();
            $keranjang = Keranjang::all();
            return view('index', compact('ongkir', 'distance', 'status', 'hewan', 'bobot', 'grade', 'gb', 'keranjang', 'transaksi', 'history', 'ht'));
    }

    private function getCoordinatesFromAddress($address)
    {
        $client = new Client();
        $response = $client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'q' => $address,
                'format' => 'json',
                'limit' => 1,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data[0]['lat']) && isset($data[0]['lon'])) {
            $latitude = $data[0]['lat'];
            $longitude = $data[0]['lon'];

            return ['latitude' => $latitude, 'longitude' => $longitude];
        }

        return null;
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometers = $miles * 1.609344;

        return $kilometers;
    }

    public function bayar(){
        $yourAddress = 'Klapanunggal';
        # code...
        if (Auth::check()) {
            // User is authenticated, access the address.
            $userAddress = Auth::user()->alamat;
        } else {
            // Handle the case where the user is not authenticated (guest).
            // For example, you can set a default address or provide a message to guests.
            $userAddress = 'Guest Address';
        }
        
        $shippingData = $this->calculateShippingCost($yourAddress, $userAddress);

        $status = $shippingData['status'];
        $ongkir = $shippingData['ongkir'];
        $distance = $shippingData['distance'];

        $hewan = Hewan::all();
        $grade = Grade::all();
        $bobot = Bobot::all();
        $history = History::all();
        $ht = HistoryTransaksi::all();
        $gb = GradeBobot::all();
        $transaksi = Transaction::all();
        $keranjang = Keranjang::all();
        
        return view('bayar', compact('ongkir' ,'distance', 'status', 'hewan', 'bobot', 'grade', 'gb', 'keranjang', 'transaksi', 'history', 'ht'));
    }

    public function show(Hewan $hewan){
        $yourAddress = 'Klapanunggal';
            # code...
            if (Auth::check()) {
                // User is authenticated, access the address.
                $userAddress = Auth::user()->alamat;
            } else {
                // Handle the case where the user is not authenticated (guest).
                // For example, you can set a default address or provide a message to guests.
                $userAddress = 'Guest Address';
            }
            
            $shippingData = $this->calculateShippingCost($yourAddress, $userAddress);

            $status = $shippingData['status'];
            $ongkir = $shippingData['ongkir'];
            $distance = $shippingData['distance'];

        $nama = $hewan->nama;
        $id = $hewan->id;
        $img = $hewan->coverimg;
        $qty = $hewan->qty;
        $grade = Grade::all();
        $gb = GradeBobot::all();
        $bobot = Bobot::all();
        $history = History::all();
        $ht = HistoryTransaksi::all();
        $transaksi = Transaction::all();
        $keranjang = Keranjang::all();
        $hewangrade = $hewan->relationToGrade;
        $hewanbobot = $hewan->relationToBobot;
        return view('hewan', compact('ongkir' , 'distance', 'status', 'nama','id', 'img', 'qty', 'bobot', 'hewangrade', 'hewanbobot','grade', 'gb', 'keranjang', 'transaksi', 'history', 'ht'));
    }

}
