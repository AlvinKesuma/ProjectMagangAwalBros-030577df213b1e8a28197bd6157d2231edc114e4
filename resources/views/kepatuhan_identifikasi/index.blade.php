@extends('layouts.app')

@section('title')
Data Kepatuhan Identifikasi
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
                <h4>Data Kepatuhan Identifikasi </h4>
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
                            <th>KIP 1</th>
                            <th>KIP 2</th>
                            <th>KIP 3</th>
                            <th>KIP 4</th>
                            <th>Num</th>
                            <th>Denum</th>
                            <th>Num Denum</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->kip1 }}</td>
                                <td>{{ $item->kip2 }}</td>
                                <td>{{ $item->kip3 }}</td>
                                <td>{{ $item->kip4 }}</td>
                                <td>{{ $item->num }}</td>
                                <td>{{ $item->denum }}</td>
                                <td>{{ is_numeric($item->numdenum) ? number_format($item->numdenum, 2) : $item->numdenum }}</td>
                                <td>{{ $item->month }}</td>
                                <td>{{ $item->year }}</td>
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
                                    <form action="{{ route('kepatuhan-identifikasi.destroy', $item->id) }}" method="POST" class="d-inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data.</td>
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
                <h5 class="modal-title" id="exampleModalLabel1">Form Data Kepatuhan Identifikasi</h5>
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
                            <label for="kip1" class="form-label">KIP 1</label>
                            <input type="number" step="0.1" id="kip1" name="kip1" class="form-control" placeholder="Masukkan KIP 1" required>
                        </div>
                        <div class="col">
                            <label for="kip2" class="form-label">KIP 2</label>
                            <input type="number" step="0.1" id="kip2" name="kip2" class="form-control" placeholder="Masukkan KIP 2" required>
                        </div>
                        <div class="col">
                            <label for="kip3" class="form-label">KIP 3</label>
                            <input type="number" step="0.1" id="kip3" name="kip3" class="form-control" placeholder="Masukkan KIP 3" required>
                        </div>
                        <div class="col">
                            <label for="kip4" class="form-label">KIP 4</label>
                            <input type="number" step="0.1" id="kip4" name="kip4" class="form-control" placeholder="Masukkan KIP 4" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label for="num" class="form-label">Num</label>
                            <input type="number" step="0.1" id="num" name="num" class="form-control" placeholder="Num" readonly>
                        </div>
                        <div class="col">
                            <label for="denum" class="form-label">Denum</label>
                            <input type="number" step="0.1" id="denum" name="denum" class="form-control" placeholder="Denum" readonly>
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
                        <label for="year" class="form-label">Tahun</label>
                        <select id="year" name="year" class="form-select" required>
                            <option value="">Pilih Tahun</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
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
    
    function calculateSum() {
        const kip1 = parseFloat(document.getElementById('kip1').value) || 0;
        const kip2 = parseFloat(document.getElementById('kip2').value) || 0;
        const kip3 = parseFloat(document.getElementById('kip3').value) || 0;
        const kip4 = parseFloat(document.getElementById('kip4').value) || 0;

        const sum = kip1 + kip2 + kip3 + kip4;

        document.getElementById('num').value = sum;
        document.getElementById('denum').value = sum;
    }

    document.querySelectorAll('#kip1, #kip2, #kip3, #kip4').forEach(input => {
        input.addEventListener('input', calculateSum);
    });

    function openCreateModal() {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ route('kepatuhan-identifikasi.store') }}";
        document.getElementById('formModal').querySelector('[name="_method"]').value = "POST";
        document.getElementById('exampleModalLabel1').innerText = "Tambah Data Kepatuhan Identifikasi";

        // Autofill unit field with "Kamar Bedah"
        document.getElementById('unit').value = "Mutu";
    }

    function openEditModal(data) {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ url('kepatuhan-identifikasi') }}/" + data.id;
        document.getElementById('formModal').querySelector('[name="_method"]').value = "PUT";
        document.getElementById('exampleModalLabel1').innerText = "Edit Data Kepatuhan Identifikasi";
        
        document.getElementById('unit').value = data.unit;
        document.getElementById('kip1').value = data.kip1;
        document.getElementById('kip2').value = data.kip2;
        document.getElementById('kip3').value = data.kip3;
        document.getElementById('kip4').value = data.kip4;
        document.getElementById('num').value = data.num;
        document.getElementById('denum').value = data.denum;
        document.getElementById('month').value = data.month;
        document.getElementById('year').value = data.year;
    }
</script>
@endsection
