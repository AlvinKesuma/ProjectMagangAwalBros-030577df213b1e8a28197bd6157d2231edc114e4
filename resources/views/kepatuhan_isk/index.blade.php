@extends('layouts.app')

@section('title')
Data Kepatuhan Penerapan HAIs: ISK
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <!-- Toast for success messages -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
                <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <h4>Data Kepatuhan Penerapan HAIs: ISK</h4>
                <!-- Button trigger modal for creating data -->
                <button
                  type="button"
                  class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#basicModal"
                  onclick="openCreateModal()"
                >
                  Tambah Data
                </button>
            </div>
            
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Unit</th>
                            <th>Num</th>
                            <th>Denum</th>
                            <th>Bulan</th>
                            <th>2023</th>
                            <th>2024</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->num }}</td>
                                <td>{{ $item->denum }}</td>
                                <td>{{ $item->month }}</td>
                                <td>{{ $item->tahun_2023 }}</td>
                                <td>{{ $item->tahun_2024 }}</td>
                                <td>
                                    <!-- Button trigger modal for editing data -->
                                    <button
                                      type="button"
                                      class="btn btn-warning btn-sm"
                                      data-bs-toggle="modal"
                                      data-bs-target="#basicModal"
                                      onclick="openEditModal({{ $item }})"
                                    >
                                      Edit
                                    </button>
                                    <form action="{{ route('kepatuhan-isk.destroy', $item->id) }}" method="POST" class="d-inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <h5>
                    @if(isset($item->growth))
                        Growth: {{ $item->growth }} %
                    @else
                        Growth: Data belum ada
                    @endif
                </h5>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Create/Edit -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Form Data Kepatuhan Penerapan HAIs: ISK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formModal" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') 
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" id="unit" name="unit" class="form-control" placeholder="Masukkan Unit" readonly>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label for="num" class="form-label">Num</label>
                            <input type="number" step="0.1" id="num" name="num" class="form-control" placeholder="Masukkan Num" required>
                        </div>
                        <div class="col">
                            <label for="denum" class="form-label">Denum</label>
                            <input type="number" step="0.1" id="denum" name="denum" class="form-control" placeholder="Masukkan Denum" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="month" class="form-label">Bulan</label>
                        <select id="month" name="month" class="form-select" required>
                            <option value="">Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="col">
                            <label for="tahun_2023" class="form-label">Tahun 2023</label>
                            <input type="number" step="0.1" id="tahun_2023" name="tahun_2023" class="form-control" placeholder="Masukkan nilai tahun 2023" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col">
                            <label for="tahun_2024" class="form-label">Tahun 2024</label>
                            <input type="number" id="tahun_2024" name="tahun_2024" class="form-control" placeholder="Nilai tahun 2024" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Show the toast if there's a success message
        @if (session('success'))
            var toast = new bootstrap.Toast(document.getElementById('successToast'));
            toast.show();
        @endif

        // Handle delete button click
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                const confirmDeleteButton = document.getElementById('confirmDeleteButton');
                
                // Open confirmation modal
                var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
                confirmDeleteModal.show();

                // Set event for confirm delete button
                confirmDeleteButton.onclick = function() {
                    form.submit();
                };
            });
        });
    });
    
    function calculate() {        
        const num = parseFloat(document.getElementById('num').value) || 0;
        const denum = parseFloat(document.getElementById('denum').value) || 0;

        // Calculate tahun_2024
        const tahun_2024 = denum !== 0 ? ((num / denum) * 100).toFixed(1) : 0;
        document.getElementById('tahun_2024').value = tahun_2024;

        // Get values for quarterly calculations based on the month selected
        const month = document.getElementById('month').value;

        // Quarter Arrays
        const firstQuarterMonths = ['Januari', 'Februari', 'Maret'];
        const secondQuarterMonths = ['April', 'Mei', 'Juni'];
        const thirdQuarterMonths = ['Juli', 'Agustus', 'September'];
        const fourthQuarterMonths = ['Oktober', 'November', 'Desember'];

        let tw1num = 0, tw2num = 0, tw3num = 0, tw4num = 0;
        let tw1denum = 0, tw2denum = 0, tw3denum = 0, tw4denum = 0;

        // Calculate quarter sums based on the month selected
        if (firstQuarterMonths.includes(month)) {
            tw1num += num;
            tw1denum += denum;
        } else if (secondQuarterMonths.includes(month)) {
            tw2num += num;
            tw2denum += denum;
        } else if (thirdQuarterMonths.includes(month)) {
            tw3num += num;
            tw3denum += denum;
        } else if (fourthQuarterMonths.includes(month)) {
            tw4num += num;
            tw4denum += denum;
        }

        // Calculate tahun2024 for quarters
        const tw1tahun2024 = tw1denum !== 0 ? ((tw1num / tw1denum) * 100).toFixed(1) : 0;
        const tw2tahun2024 = tw2denum !== 0 ? ((tw2num / tw2denum) * 100).toFixed(1) : 0;
        const tw3tahun2024 = tw3denum !== 0 ? ((tw3num / tw3denum) * 100).toFixed(1) : 0;
        const tw4tahun2024 = tw4denum !== 0 ? ((tw4num / tw4denum) * 100).toFixed(1) : 0;

        // Calculate average for tahun 2023
        const tw1tahun2023 = (tw1num + tw2num + tw3num + tw4num) / 3 || 0;
        const tw2tahun2023 = (tw1denum + tw2denum + tw3denum + tw4denum) / 3 || 0;

        const hasiltwnum = tw1num + tw2num + tw3num + tw4num;
        const hasiltwdenum = tw1denum + tw2denum + tw3denum + tw4denum;

        const hasiltw2024 = hasiltwdenum !== 0 ? ((hasiltwnum / hasiltwdenum) * 100).toFixed(1) : 0;
        const hasiltw2023 = (tw1tahun2023 + tw2tahun2023) / 2 || 0;

        const growth = hasiltw2024 / hasiltw2023 - 1;

        console.log("Growth:", growth + "%");
    }

    document.querySelectorAll('#num, #denum').forEach(input => {
        input.addEventListener('input', calculate);
    });

    function openCreateModal() {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ route('kepatuhan-isk.store') }}";
        document.getElementById('formModal').querySelector('[name="_method"]').value = "POST";
        document.getElementById('exampleModalLabel1').innerText = "Tambah Data Kepatuhan Penerapan HAIs: ISK";

        // Autofill unit field with "PPI"
        document.getElementById('unit').value = "PPI";
    }

    function openEditModal(data) {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ url('kepatuhan-isk') }}/" + data.id;
        document.getElementById('formModal').querySelector('[name="_method"]').value = "PUT";
        document.getElementById('exampleModalLabel1').innerText = "Edit Data Kepatuhan Penerapan HAIs: ISK";
        
        document.getElementById('unit').value = data.unit;
        document.getElementById('num').value = data.num;
        document.getElementById('denum').value = data.denum;
        document.getElementById('month').value = data.month;
        document.getElementById('tahun_2023').value = data.tahun_2023;
        document.getElementById('tahun_2024').value = data.tahun_2024;
    }
</script>
@endsection
