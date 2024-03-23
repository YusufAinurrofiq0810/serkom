<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Menu Admin</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a class="nav-link nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Admin</div>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a>
                            <span class="brand-text">Demonstrasi</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-fire"></i>
                                <span>Home</span></a>
                        </li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-user"></i>
                                <span>Admin</span></a>
                        </li>
                    </ul>

                    <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Content -->
            <div class="main-content">
                {{-- TAMBAH MAHASISWA --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Mahasiswa</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form id="tambah-mahasiswa" action="{{ url('/admin/tambah-mahasiswa') }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <div>
                                            <input type="number" class="form-control" id="nim" name="nim"
                                                placeholder="tipe number maksimal 9 angka">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <div>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="masukkan nama mahasiswa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <div>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="masukkan alamat mahasiswa">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal lahir">Tanggal Lahir</label>
                                        <div>
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <div>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="usia">Usia</label>
                                        <div>
                                            <input type="number" class="form-control" id="usia" name="usia"
                                                placeholder="masukkan usia mahasiswa">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TAMBAH MAHASISWA --}}

                {{-- EDIT MAHASISWA --}}
                @foreach ($mahasiswa as $mhs)
                    <div class="modal fade" id="myEdit{{ $mhs->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ $mhs->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Mahasiswa</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form id="edit-mahasiswa{{ $mhs->id }}"
                                        action="{{ url('/admin/edit-mahasiswa', $mhs->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <div>
                                                <input type="number" class="form-control"
                                                    id="nim{{ $mhs->id }}" name="nim"
                                                    placeholder="tipe number maksimal 9 angka"
                                                    value="{{ $mhs->nim }}" required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <div>
                                                <input type="text" class="form-control"
                                                    id="nama{{ $mhs->id }}" name="nama"
                                                    placeholder="masukkan nama mahasiswa" value="{{ $mhs->nama }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <div>
                                                <input type="text" class="form-control"
                                                    id="alamat{{ $mhs->id }}" name="alamat"
                                                    placeholder="masukkan alamat mahasiswa"
                                                    value="{{ $mhs->alamat }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal lahir">Tanggal Lahir</label>
                                            <div>
                                                <input type="date" class="form-control"
                                                    id="tgl_lahir{{ $mhs->id }}" name="tgl_lahir"
                                                    value="{{ $mhs->tgl_lahir }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <div>
                                                <select class="form-control" id="gender{{ $mhs->id }}"
                                                    name="gender">
                                                    <option value="L"
                                                        {{ $mhs->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P"
                                                        {{ $mhs->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="usia">Usia</label>
                                            <div>
                                                <input type="number" class="form-control"
                                                    id="usia{{ $mhs->id }}" name="usia"
                                                    placeholder="masukkan usia mahasiswa" value="{{ $mhs->usia }}"
                                                    required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- END EDIT MAHASISWA --}}

                {{-- LIST MAHASISWA --}}
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Mahasiswa</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                            Mahasiswa</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">NIM</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">Tanggal Lahir</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Usia</th>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($mahasiswa as $item)
                                                    <tr>
                                                        <td>{{ $item->nim }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->alamat }}</td>
                                                        <td>{{ $item->tgl_lahir }}</td>
                                                        <td>{{ $item->gender }}</td>
                                                        <td>{{ $item->usia }}</td>
                                                        <td>
                                                            <a class="btn btn-warning btn-action" title="Edit"
                                                                data-toggle="modal"
                                                                data-target="#myEdit{{ $item->id }}"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-danger btn-action"
                                                                href="{{ url('admin/hapus-mahasiswa' . $item->id) }}">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">belum ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{-- {{ $admin->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('stisla/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/js/custom.js') }}"></script>

    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    @if (session('pop-up'))
        @php
            $message = session('pop-up');
        @endphp
        <script>
            Swal.fire(
                '{{ $message['head'] }}',
                '{!! str_replace("'", "\'", $message['body']) !!}',
                '{{ $message['status'] }}'
            )
        </script>
    @endif
</body>

</html>
