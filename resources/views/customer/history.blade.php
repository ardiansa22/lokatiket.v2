@extends('customer.layouts.app')

@section('content')
<div class="container py-3 text-center">
    <h5>Riwayat Tiket</h5>
</div>
    <div class="container">
        @if($order->isEmpty())
            <p class="text-center">Tidak ada riwayat pesanan yang ditemukan.</p>
        @else
            <table class="table">
                <tbody>
                    @foreach($order as $key => $item)
                        <tr> 
                            <td ><i class="fa-solid fa-tree"></i></td>
                            <td style="font-size:18px;"><b>{{ $item->wisata->name }}</b>
                                <span class ="text-muted"style="display: block; margin-top: 5px; font-size:12px;">{{$item->created_at}}</span>
                            </td>
                            <td class="text-end">-Rp. {{ $item->total_price }}</td>
                            <td class="text-end"><a href="/customer/invoice/{{$item->id}}">Tiket</a></td>
                            <td class="text-end"><a href="">Ulasan</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
