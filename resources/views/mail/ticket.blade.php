@component('mail::message')
    # Tiket AOM 10.0 Anda

    Selamat! Pembayaran Anda telah berhasil diproses.

    @component('mail::panel')
        **Detail Pemesanan:**
        - **Order ID:** {{ $order->order_id }}
        - **Nama:** {{ $order->name }}
        - **Jenis Tiket:** {{ $order->ticket->name ?? 'General' }}
        - **Harga:** Rp {{ number_format($order->total_price, 0, ',', '.') }}
        - **Status:** {{ ucfirst($order->status) }}
    @endcomponent

    ## Informasi Tiket Digital

    **Barcode:** `{{ $order->barcode }}`

    QR Code tiket Anda telah dilampirkan dalam email ini. Silakan:
    1. **Download** file QR Code yang terlampir
    2. **Simpan** di galeri ponsel Anda
    3. **Tunjukkan** QR Code saat penukaran tiket fisik

    @component('mail::button', ['url' => url('/'), 'color' => 'success'])
        Kembali ke Website
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
