@extends('layouts.app')

@section('title')
Data Kepuasan Pasien (IKM)
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
                <h4>Data Kepuasan Pasien (IKM)</h4>
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
                                    <form action="{{ route('kepuasan-pasien.destroy', $item->id) }}" method="POST" class="d-inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-button">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data.</td>
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
                <h5 class="modal-title" id="exampleModalLabel1">Form Data Kepuasan Pasien (IKM)</h5>
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
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label for="tahun_2023" class="form-label">2023</label>
                            <input type="number" step="0.1" id="tahun_2023" name="tahun_2023" class="form-control" placeholder="Masukkan Nilai" required>
                        </div>
                        <div class="col">
                            <label for="tahun_2024" class="form-label">2024</label>
                            <input type="number" step="0.1" id="tahun_2024" name="tahun_2024" class="form-control" placeholder="Masukkan Nilai" required>
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

    function openCreateModal() {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ route('kepuasan-pasien.store') }}";
        document.getElementById('formModal').querySelector('[name="_method"]').value = "POST";
        document.getElementById('exampleModalLabel1').innerText = "Tambah Data Kepuasan Pasien (IKM)";

        // Autofill unit field with "CRO"
        document.getElementById('unit').value = "CRO";
    }

    function openEditModal(data) {
        document.getElementById('formModal').reset();
        document.getElementById('formModal').action = "{{ url('kepuasan-pasien') }}/" + data.id;
        document.getElementById('formModal').querySelector('[name="_method"]').value = "PUT";
        document.getElementById('exampleModalLabel1').innerText = "Edit Data Kepuasan Pasien (IKM)";
        
        document.getElementById('unit').value = data.unit;
        document.getElementById('month').value = data.month;
        document.getElementById('tahun_2023').value = data.num;
        document.getElementById('tahun_2024').value = data.denum;
    }
</script>
@endsection
