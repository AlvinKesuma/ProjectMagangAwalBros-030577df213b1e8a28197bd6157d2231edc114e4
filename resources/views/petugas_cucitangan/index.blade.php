@extends('layouts.app')

@section('title')
Data Kepatuhan petugas cuci tangan sebelum kontak ke pasien
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Total TW 2023 Card -->
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <!-- Icon and Title -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-calendar-alt text-secondary" style="font-size: 40px;"></i>
                        <span class="ms-3 fw-bold text-dark fs-5">2023</span>
                    </div>
                    <!-- TW 2023 Value -->
                    <h3 class="card-title text-center text-secondary fs-4">
                        {{ number_format($results['hasiltw2023'] ?? 0, 2) }}%
                    </h3>
                </div>
            </div>
        </div>

        <!-- Total TW 2024 Card -->
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <!-- Icon and Title -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-calendar-check text-primary" style="font-size: 40px;"></i>
                        <span class="ms-3 fw-bold text-dark fs-5">2024</span>
                    </div>
                    <!-- TW 2024 Value -->
                    <h3 class="card-title text-center text-primary fs-4">
                        {{ number_format($results['hasiltw2024'] ?? 0, 2) }}%
                    </h3>
                </div>
            </div>
        </div>

        <!-- Growth Card -->
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex flex-column align-items-center justify-content-between">
                    <!-- Icon and Title -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-chart-line text-success" style="font-size: 40px;"></i>
                        <span class="ms-3 fw-bold text-dark fs-5">Growth</span>
                    </div>
                    <!-- Growth Percentage -->
                    <h3 class="card-title text-center text-{{ isset($results['growth']) ? ($results['growth'] >= 0 ? 'success' : 'danger') : 'muted' }} fs-4">
                        @if(isset($results['growth']))
                            {{ number_format($results['growth'], 2) }} %
                        @else
                            <span class="text-muted">Data belum tersedia</span>
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>
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
                <h4>Data Kepatuhan petugas cuci tangan sebelum kontak ke pasien </h4>
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
                                    <form action="{{ route('petugas-cucitangan.destroy', $item->id) }}" method="POST" class="d-inline-block delete-form">
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
        </div>
    </div>
</div>

<!-- Modal for Create/Edit -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Form Data Petugas Cuci Tangan</h5>
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

        const tahun_2024 = denum !== 0 ? ((num / denum) * 100).toFixed(1) : 0;
        document.getElementById('tahun_2024').value = tahun_2024;
    }

    document.querySelectorAll('#num, #denum').forEach(input => {
        input.addEventListener('input', calculate);
    });

    function openCreateModal() {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ route('petugas-cucitangan.store') }}";
        document.getElementById('formModal').querySelector('[name="_method"]').value = "POST";
        document.getElementById('exampleModalLabel1').innerText = "Tambah Data Kepatuhan petugas cuci tangan sebelum kontak ke pasien";
        document.getElementById('unit').value = "PPI";
    }

    function openEditModal(data) {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ url('petugas-cucitangan') }}/" + data.id;
        document.getElementById('formModal').querySelector('[name="_method"]').value = "PUT";
        document.getElementById('exampleModalLabel1').innerText = "Edit Data Kepatuhan petugas cuci tangan sebelum kontak ke pasien";
        
        document.getElementById('unit').value = data.unit;
        document.getElementById('num').value = data.num;
        document.getElementById('denum').value = data.denum;
        document.getElementById('month').value = data.month;
        document.getElementById('tahun_2023').value = data.tahun_2023;
        document.getElementById('tahun_2024').value = data.tahun_2024;
    }
</script>
@endsection
