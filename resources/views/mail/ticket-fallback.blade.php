@component('mail::message')
    # Tiket AOM 10.0 Anda

    Selamat! Pembayaran Anda telah berhasil diproses.

    @component('mail::panel')
        **Detail Pemesanan:**
        @if (isset($order))
            - **Order ID:** {{ $order->order_id }}
            - **Nama:** {{ $order->name }}
            - **Jenis Tiket:** {{ $order->ticket->name ?? 'General' }}
            - **Harga:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
            - **Status:** {{ ucfirst($order->status) }}
            - **Barcode:** `{{ $order->barcode }}`
        @else
            - **Order ID:** {{ $orderId ?? 'Tidak tersedia' }}
        @endif
    @endcomponent

    ## Informasi Penting

    @if (isset($order) && $order->barcode)
        **Barcode Anda:** `{{ $order->barcode }}`

        Catat barcode di atas dan tunjukkan saat penukaran tiket fisik.
    @else
        Silakan cek halaman riwayat pemesanan Anda di website untuk detail lengkap tiket.
    @endif

    @component('mail::button', ['url' => url('/'), 'color' => 'primary'])
        Cek Status Pemesanan
    @endcomponent

    ---

    **Catatan Penting:**
    - Tiket hanya berlaku untuk **1x penggunaan**
    - Harap tiba **30 menit** sebelum acara dimulai
    - Bawa identitas diri yang valid
    - Jika mengalami kendala, hubungi panitia

    Terima kasih atas partisipasinya!

    Hormat kami,<br>
    **Tim {{ config('app.name', 'AOM 10.0') }}**
@endcomponent
