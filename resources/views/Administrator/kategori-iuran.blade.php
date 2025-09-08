@extends('Administrator.template')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="page-title mb-0"><i class="fas fa-list-alt me-2"></i>Kategori Iuran</h1>
            <a class="btn btn-light" href="{{ route('iuran-create') }}">
        <i class="fas fa-plus-circle me-1"></i> Tambah Kategori Iuran
        </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Periode</th>
                            <th scope="col">Nominal</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dues as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->period }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if ($item->status == 'Aktif')
                                    <span class="badge bg-success rounded-pill px-3 py-2">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-warning btn-sm " href="{{ route('iuran-edit', Crypt::encrypt($item->id)) }}" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm " href="{{ route('iuran-delete', Crypt::encrypt($item->id)) }}" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($dues->hasPages())
            <div class="card-footer bg-transparent">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        @if ($dues->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $dues->previousPageUrl() }}">Previous</a>
                            </li>
                        @endif

                        @foreach ($dues->getUrlRange(1, $dues->lastPage()) as $page => $url)
                            <li class="page-item {{ $dues->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($dues->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $dues->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>

    <!-- Empty State -->
    @if($dues->count() == 0)
    <div class="text-center py-5">
        <i class="fas fa-list-alt fa-4x text-muted mb-3"></i>
        <h4 class="text-muted">Belum ada data kategori iuran</h4>
        <p class="text-muted">Mulai dengan menambahkan data kategori iuran baru</p>
        <a class="btn btn-primary-custom mt-2" href="{{ route('iuran-create') }}">
            <i class="fas fa-plus-circle me-1"></i> Tambah Data
        </a>
    </div>
    @endif
</div>

<style>
    .page-header {
        background: linear-gradient(135deg, #386641 0%, #2c4a32 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary-custom {
        background-color: #386641;
        color: #FED16A;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-primary-custom:hover {
        background-color: #2c4a32;
        color: #FED16A;
        transform: translateY(-2px);
    }
    
    .card {
        border-radius: 0.75rem;
        border: none;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
    }
    
    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .badge {
        font-size: 0.8rem;
    }
    
    /* Responsive styles */
    @media (max-width: 768px) {
        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
        }
        
        .table tbody td {
            display: block;
            text-align: right;
            padding: 0.75rem;
            position: relative;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table tbody td:last-child {
            border-bottom: none;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 0.75rem;
            width: 45%;
            padding-right: 1rem;
            font-weight: 600;
            text-align: left;
        }
        
        .table tbody td[data-label] {
            padding-left: 50%;
        }
        
        /* Set data labels for each column */
        .table tbody td:nth-child(1)::before { content: "No"; }
        .table tbody td:nth-child(2)::before { content: "Periode"; }
        .table tbody td:nth-child(3)::before { content: "Nominal"; }
        .table tbody td:nth-child(4)::before { content: "Status"; }
        .table tbody td:nth-child(5)::before { content: "Dibuat Pada"; }
        .table tbody td:nth-child(6)::before { content: "Aksi"; }
        
        .table tbody td.text-center {
            text-align: right;
        }
        
        .d-flex.gap-2 {
            justify-content: flex-end;
        }
    }
    
    @media (max-width: 576px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .btn-primary-custom {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for delete action
        const deleteButtons = document.querySelectorAll('a[onclick*="confirm"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
        
        // Add data-label attributes for responsive table
        if (window.innerWidth <= 768) {
            const headers = ['No', 'Periode', 'Nominal', 'Status', 'Dibuat Pada', 'Aksi'];
            const cells = document.querySelectorAll('.table tbody td');
            
            cells.forEach((cell, index) => {
                const headerIndex = index % headers.length;
                cell.setAttribute('data-label', headers[headerIndex]);
            });
        }
    });
</script>
@endsection