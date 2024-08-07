@extends('customer.layouts.app')

@section('content')
<div class="container py-3 text-center">
    <h5>Riwayat Tiket</h5>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
<div class="container">
    @if($order->isEmpty())
        <p class="text-center">Tidak ada riwayat pesanan yang ditemukan.</p>
    @else
        <table class="table">
            <tbody>
                @foreach($order as $key => $item)
                    <tr>
                        <td style="font-size: 32px;
  height: 30px;background-color:#0046BF ;color : #FFCB05; text-align:center;"><i class="fa-solid fa-tree"></i></td>
                        <td style="font-size:18px;"><b>{{ $item->wisata->name }}</b>
                            <span class="text-muted" style="display: block; margin-top: 5px; font-size:12px;">{{ $item->created_at }}</span>
                        </td>
                        <td class="text-end">-Rp.{{ number_format($item->total_price, 0, ',', '.') }}</td>
                        <td class="text-end"><a href="/customer/invoice/{{ $item->id }}">Tiket</a></td>
                        <td class="text-end"><a href="/customer/ulasan/{{$item->wisata_id}}/{{$item->id}}">Ulasan</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
