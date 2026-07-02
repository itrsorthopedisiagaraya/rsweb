@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard_pesan') }}
@endsection

@section('content')
    <h3>Data Kritik dan Saran</h3>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered __datatables" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email and Phone</th>
                    <th>Rating</th>
                    <th>Kritik/Saran</th>
                    <th>Tanggal dibuat</th>
                    <th class="">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kritikSaran as $key => $item)

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if ($item->gambar)
                                @php
                                    $images = is_string($item->gambar)
                                        ? json_decode($item->gambar, true)
                                        : $item->gambar;
                                @endphp

                                @if (!empty($images))
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($images as $img)
                                            <img src="{{ asset('files/gambar_kritiksaran/' . $img) }}" alt="Foto"
                                                width="50" height="50" style="object-fit: cover; margin-right: 5px;">
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ $item->nama }}</td>
                        @php
                            $phone = preg_replace('/[^0-9]/', '', $item->no_telepon);

                            if (Str::startsWith($phone, '0')) {
                                $phone = '62' . substr($phone, 1);
                            }
                        @endphp
                        <td>
                            <p>{{ $item->email }}</p>

                            <p>
                                <a href="https://wa.me/{{ $phone }}?text={{ urlencode('Halo, kami dari admin. Terima kasih atas feedback Anda.') }}"
                                    target="_blank">
                                    Chat WhatsApp
                                </a>
                            </p>
                        </td>
                        <td>
                            @switch($item->rating)
                                @case(5)
                                    <span class="text-warning">★★★★★</span>
                                    <small class="text-success d-block">Sangat Baik</small>
                                @break

                                @case(4)
                                    <span class="text-warning">★★★★☆</span>
                                    <small class="text-primary d-block">Baik</small>
                                @break

                                @case(3)
                                    <span class="text-warning">★★★☆☆</span>
                                    <small class="text-secondary d-block">Cukup</small>
                                @break

                                @case(2)
                                    <span class="text-warning">★★☆☆☆</span>
                                    <small class="text-danger d-block">Kurang</small>
                                @break

                                @case(1)
                                    <span class="text-warning">★☆☆☆☆</span>
                                    <small class="text-danger d-block">Sangat Kurang</small>
                                @break

                                @default
                                    <span class="text-muted">-</span>
                            @endswitch
                        </td>
                        <td>{{ $item->kritik_saran }}</td>
                        <td>
                            {{ $item->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('l, d/m/Y | H:i:s') }}
                        </td>
                        <td class="">
                            <form action="{{ route('kritik-saran.delete', ['id' => $item->id]) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm kritik-saran-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.__datatables').DataTable({
                "scrollX": true,
            });

            $('.kritik-saran-delete').click(function() {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });

            // get flash message with sweetalert
            @if (session('success') != null)
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}'
                });
            @endif
        });
    </script>
@endsection
