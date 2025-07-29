<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use App\Models\OfflineTransaction;
use App\Models\Ticket;
use App\Models\ticket_benefits;
use App\Models\Transaction;
use App\Models\Voucher;
use App\Services\TransactionService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('pages.admin.ticket.tickets', compact('tickets'));
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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'benefit_ticket' => 'required',
        ]);

        $create = Ticket::create($request->all());
        foreach ($request->benefit_ticket as $key => $value) {
            ticket_benefits::create([
                'id_ticket' => $create->idTicket,
                'name' => $value,
            ]);
        }
        if ($create) {
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->route('Ticket.index');
        } else {
            toast('Data gagal ditambahkan!', 'error');
            return redirect()->route('Ticket.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::with('ticket_benefit')->find($id);
        return view('pages.admin.ticket.edittickets', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ticket = Ticket::with('ticket_benefit')->find($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);
        $dataupdate = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ];
        $save = $ticket->update($dataupdate);
        // Delete all existing benefits for the ticket
        ticket_benefits::where('id_ticket', $ticket->idTicket)->delete();

        // Insert new benefits
        foreach ($request->benefit_ticket as $benefit) {
            ticket_benefits::create([
                'id_ticket' => $ticket->idTicket,
                'name' => $benefit,
            ]);
        }
        if ($save) {
            toast('Data berhasil diubah!', 'success');
            return redirect()->route('Ticket.index');
        } else {
            toast('Data gagal ditambahkan!', 'error');
            return redirect()->route('Ticket.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        toast('Data berhasil dihapus!', 'success');
        return redirect()->route('Ticket.index');
    }
    public function getData($id)
    {
        $data = Ticket::findOrFail($id);
        return response()->json(['data' => $data]);
    }
    public function buyTicket(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'payment_method' => 'required|in:bri,bca,mandiri', // Tambahkan aturan unik di sini
            'no_telp' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages[0])->flash();
            return back()->withErrors($validator)->withInput();
        }
        try {
            $id_transaction = Str::uuid();
            $userId = Auth::user()->id;
            $currentDate = now()->format('Y-m-d');

            // Collect request data
            $paymentMethod = $req->payment_method;
            $ticketName = $req->nama_ticket;
            $voucherCode = $req->kode_voucher;
            $panitiaId = $req->kode_panitia;
            // $panitiaId = null;


            // Initialize data array
            $data = [
                'id_transaction' => $id_transaction,
                'id_user' => $userId,
                'payment_method' => $paymentMethod,
                'no_telp' => $req->no_telp,
                'presence' => 0,
                'ticket_price' => 0,
                'voucher_discount' => 0,
                'confirmation' => 0,
                'transaction_fee' => 0,
                'total_prices' => 0,
            ];

            // Fetch ticket and voucher data
            $searchTicket = Ticket::where('name', $ticketName)->available()->first();
            $searchVoucher = Voucher::where('kode', $voucherCode)->where('quantity', '>', 0)->whereDate('start_date', '<=', $currentDate)->whereDate('end_date', '>=', $currentDate)->first();
            $searchPanitia = Panitia::where('id_panitia', $panitiaId)->first();

            // Update data with ticket and voucher details
            if ($searchTicket) {
                $data['id_ticket'] = $searchTicket->idTicket;
                $data['ticket_price'] = $searchTicket->price;
            }

            if ($searchVoucher) {
                $data['id_voucher'] = $searchVoucher->id_voucher;
                $data['voucher_discount'] = $searchVoucher->discount;
            }
            if($searchPanitia)
            {
                $data["id_panitia"] = $searchPanitia->id_panitia;
            }
            

            // Calculate admin fee
            $biaya_admin = $this->calculateAdminFee($paymentMethod);

            if ($biaya_admin === null) {
                return back(); // Invalid payment method
            }

            $data['transaction_fee'] = $biaya_admin < 1 ? $data['ticket_price'] * $biaya_admin : $biaya_admin;
            $data['total_prices'] = $data['ticket_price'] + $data['transaction_fee'] - $data['voucher_discount'];

            // Save transaction data
            Transaction::create($data);


            return redirect()->route('verifikasiPembayaran', ['id' => $id_transaction]);
        } catch (QueryException $e) {
            if ($e->getCode() === '45000') {
             Alert::error("Failed", "Pembelian Tiket Telah Mencapai Limit");
            }else {

            Alert::error('Failed', 'Terjadi Kesalahan Saat Memproses Permintaan');
            }
            // Log the exception and return an error response
            return redirect()->back();
        }
    }

    /**
     * Calculate the admin fee based on payment method.
     */
    private function calculateAdminFee($paymentMethod)
    {
        $fees = [
            'mandiri' => 0,
            'bca' => 0,
        ];

        return $fees[$paymentMethod] ?? null; // Return null for unknown methods
    }
    public function formPembayaran(Request $req, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $req->validate([
            "bukti_pembayaran"=> 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        if($req->hasFile("bukti_pembayaran")){
            if($transaction->bukti_pembayaran != null)
            {
                Storage::disk('public')->delete($transaction->bukti_pembayaran);
            }
            $transaction->update([
                 "confirmation" => 0,
                 "bukti_pembayaran" => $req->file("bukti_pembayaran")->store("images/bukti_pembayaran", "public"),
                 "created_at" => now()
            ]);
        }
        return redirect()->back();
    }

    
    function verifikasi($id_ticket)
    {
         $data = Transaction::with('user', 'ticket')->where('id_transaction', '=', $id_ticket)->where("id_user", '=', Auth::user()->id)->first();
         if ($data) {
            $bundleTicket = null;

            if (Str::contains($data->ticket->sales_in, 'Bundle') && $data->confirmation == 2) {
                $kode_unique = Str::slug($data->ticket->name) . "_" . $id_ticket;
                $bundleTicket = OfflineTransaction::where('tempat_penjualan', $kode_unique)->get();
            }


            return view('verifikasi', compact('data', 'bundleTicket'));
        }
        return redirect()->route('home');
    }
    function bundleEmail(Request $req, $id_ticket, TransactionService $transactionService) {
        $data = Transaction::with('user', 'ticket')->where('id_transaction', '=', $id_ticket)->where("id_user", '=', Auth::user()->id)->first();
        $minMaxCount = (int) Str::before($data->ticket->name, " "); // Extract the number from the ticket name

        $validator = Validator::make($req->all(), [
            "email_bundle" => "required|array|min:$minMaxCount|max:$minMaxCount", // Ensure the array has the exact count of items
            "email_bundle.*" => "email", // Validate each item in the array is a valid email
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($data) {
            $kode_unique = null;
            if (Str::contains($data->ticket->sales_in, 'Bundle') && $data->confirmation == 2) {
                $kode_unique = Str::slug($data->ticket->name) . "_" . $id_ticket;
            }
            if(count(array_filter($req->email_bundle)) == $minMaxCount)
            {
                foreach($req->email_bundle as $email)
                {
                    $item = [
                        "nama_lengkap" => $data->user->name,
                        "email" => $email,
                        "nama_ticket" => Str::afterLast($data->ticket->name, " "),
                        "kode_barcode" => Str::random(10),
                        "tempat_penjualan" => $kode_unique,
                        "status" => "belum"
                    ];
                    
                    $id_offline = OfflineTransaction::create($item)->id;
                    $item["id"] = $id_offline;
                    $transactionService->sendOfflineTransactionEmail($item);
                }
                
                return redirect()->route("verifikasiPembayaran", $id_ticket);
            }
            return redirect()->back()->withInput();
        }
    }
    
    function listticket() {
         $data = Transaction::with('user', 'ticket')->where('id_user', '=', Auth::user()->id)->get();
        return view('listticket',compact('data'));
    }
}
