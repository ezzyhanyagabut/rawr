@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <a href="{{ route('album') }}" class="me-3"><i
                                                class="mdi mdi-chevron-left"></i></a>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#createfoto">Unggah Foto</button>
                                        <!-- The Modal Create -->
                                        <div class="modal fade" id="createfoto">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <form action="{{ route('foto.store') }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="album_id"
                                                                    value="{{ Session('album_id') }}">
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label"><b>Unggah
                                                                            Foto</b></label>
                                                                    <input type="file" name="image"
                                                                        class="form-control text-white" id="image"
                                                                        placeholder="Foto" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label"><b>Judul
                                                                            Foto</b></label>
                                                                    <input type="text" name="title"
                                                                        class="form-control text-white" id="title"
                                                                        placeholder="Judul Foto" required>
                                                                </div>
                                                                <div class="d-grid justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-outline-success w-100">Konfirmasi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($fotos->isEmpty())
                                        <p class="text-white"><b>Anda belum mengunggah foto apapun.</b></p>
                                    @else
                                        @foreach ($fotos as $item)
                                            <div class="col-md-3 mb-4">
                                                <div class="card-sl">
                                                    <div class="card-image">
                                                        <img src="{{ asset('images/' . $item->image) }}" width="300px" height="200px" />
                                                    </div>
                                                    <form action="{{ route('like', ['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"><img src="{{ asset('icon/like.svg') }}" />like</button>
                                                    </form>
                                                    <div class="card-heading text-dark">
                                                        {{ $item->title }}
                                                    </div>
                                                    <div class="card-text">
                                                        {{ $item->like }}
                                                    </div>
                                                    <!-- The Modal Edit -->
                                                    <div class="modal fade" id="editfoto{{ $item->id }}"
                                                        aria-labelledby="editfoto{{ $item->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <form
                                                                            action="{{ route('foto.update', ['id' => $item->id]) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            {{-- <div class="mb-3">
                                                                                <label for="image"
                                                                                    class="form-label"><b>Unggah
                                                                                        Foto</b></label>
                                                                                <input type="file" name="image"
                                                                                    class="form-control text-white"
                                                                                    id="image"
                                                                                    value="{{ asset('images/' . $item->image) }}"
                                                                                    required>
                                                                            </div> --}}
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label"><b>Judul
                                                                                        Foto</b></label>
                                                                                <input type="text" name="title"
                                                                                    class="form-control text-white"
                                                                                    id="title"
                                                                                    value="{{ $item->title }}" required>
                                                                            </div>
                                                                            <div class="d-grid justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-warning w-100">Konfirmasi</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- The Modal Delete -->
                                                    <div class="modal fade" id="deletefoto{{ $item->id }}"
                                                        aria-labelledby="deletefoto{{ $item->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <form
                                                                            action="{{ route('foto.destroy', ['id' => $item->id]) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label text-white">Apakah
                                                                                    anda
                                                                                    ingin
                                                                                    menghapus <b>Foto
                                                                                        {{ $item->title }}</b>?</label>
                                                                            </div>
                                                                            <div class="d-grid justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger w-100"><i
                                                                                        class="mdi mdi-delete me-2"></i>Hapus
                                                                                    Foto</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
